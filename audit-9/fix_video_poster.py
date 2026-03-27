#!/usr/bin/env python3
import MySQLdb
import os
import glob

DB_NAME = 'dbfjyffxpyejpa'
DB_USER = 'uw7wam3vp6ghx'
with open('/home/customer/tmp/mysql.txt') as f:
    DB_PASS = f.read().strip()
DB_HOST = '127.0.0.1'

conn = MySQLdb.connect(host=DB_HOST, user=DB_USER, passwd=DB_PASS, db=DB_NAME)
cursor = conn.cursor()

# Find a good hero image to use for About page
# peru.jpg (ID 46867) is 4032x3024 - good landscape photo
# Let's also check other recent photos
cursor.execute("SELECT ID, post_name, guid FROM tnf_posts WHERE post_type='attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID DESC LIMIT 10")
imgs = cursor.fetchall()
print("Recent images:")
for img in imgs:
    print(f"  ID={img[0]}, name={img[1]}, url={img[2]}")

# peru.jpg URL
peru_url = "https://ernien.sg-host.com/wp-content/uploads/2026/03/peru.jpg"
peru_id = 46867

# Update About page video poster
cursor.execute("SELECT meta_value FROM tnf_postmeta WHERE post_id = 46519 AND meta_key = '_elementor_data'")
row = cursor.fetchone()
if row:
    data = row[0]
    # Replace generated-image.png poster with peru.jpg
    # The poster URL is: "url":"https:\/\/ernien.sg-host.com\/wp-content\/uploads\/2026\/03\/generated-image.png"
    old_poster = 'generated-image.png'
    new_poster = 'peru.jpg'
    if old_poster in data:
        data_new = data.replace(old_poster, new_poster)
        cursor.execute("UPDATE tnf_postmeta SET meta_value = %s WHERE post_id = 46519 AND meta_key = '_elementor_data'", (data_new,))
        conn.commit()
        print(f"About page video poster updated: {old_poster} -> {new_poster}")
    else:
        print("About page: generated-image.png not found in elementor data (may already be fixed)")
else:
    print("About page elementor data not found")

conn.close()
