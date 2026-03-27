#!/usr/bin/env python3
import MySQLdb
import glob
import os

DB_NAME = 'dbfjyffxpyejpa'
DB_USER = 'uw7wam3vp6ghx'
with open('/home/customer/tmp/mysql.txt') as f:
    DB_PASS = f.read().strip()
DB_HOST = '127.0.0.1'

conn = MySQLdb.connect(host=DB_HOST, user=DB_USER, passwd=DB_PASS, db=DB_NAME)
cursor = conn.cursor()

# Get current kit settings (post_id = 52)
cursor.execute("SELECT meta_value FROM tnf_postmeta WHERE post_id = 52 AND meta_key = '_elementor_page_settings'")
row = cursor.fetchone()
if not row:
    print("No kit settings found!")
    exit(1)

meta_value = row[0]

# Primary color: #404F40 (green) -> #C4703B (burnt orange)
# Accent color: #ED5A2F -> #C4703B
meta_new = meta_value.replace('#404F40', '#C4703B').replace('#ED5A2F', '#C4703B')

print(f"Original meta length: {len(meta_value)}, New length: {len(meta_new)}")

# Update kit settings
cursor.execute("UPDATE tnf_postmeta SET meta_value = %s WHERE post_id = 52 AND meta_key = '_elementor_page_settings'", (meta_new,))
conn.commit()
print(f"Kit colors updated. Rows affected: {cursor.rowcount}")

# Also fix hardcoded #404F40 in About page (post_id for about = 46519)
cursor.execute("SELECT meta_value FROM tnf_postmeta WHERE post_id = 46519 AND meta_key = '_elementor_data'")
row2 = cursor.fetchone()
if row2:
    about_meta = row2[0]
    about_new = about_meta.replace('#404F40', '#C4703B')
    if about_meta != about_new:
        cursor.execute("UPDATE tnf_postmeta SET meta_value = %s WHERE post_id = 46519 AND meta_key = '_elementor_data'", (about_new,))
        conn.commit()
        print(f"About page #404F40 fixed. Rows affected: {cursor.rowcount}")
    else:
        print("About page: no #404F40 found")

# Also fix in other pages - search for #404F40 in all elementor data
cursor.execute("SELECT post_id, meta_key FROM tnf_postmeta WHERE meta_value LIKE '%#404F40%'")
green_pages = cursor.fetchall()
for post_id, meta_key in green_pages:
    cursor.execute(f"SELECT meta_value FROM tnf_postmeta WHERE post_id = %s AND meta_key = %s", (post_id, meta_key))
    r = cursor.fetchone()
    if r:
        m = r[0].replace('#404F40', '#C4703B')
        cursor.execute("UPDATE tnf_postmeta SET meta_value = %s WHERE post_id = %s AND meta_key = %s", (m, post_id, meta_key))
        conn.commit()
        print(f"Fixed #404F40 in post_id={post_id}, meta_key={meta_key}")

# Clear Elementor CSS cache
cache_dir = '/home/customer/www/ernien.sg-host.com/public_html/wp-content/uploads/elementor/css'
if os.path.isdir(cache_dir):
    for f in glob.glob(f"{cache_dir}/post-*.css"):
        os.unlink(f)
        print(f"Deleted cache: {f}")

print("Done.")
conn.close()
