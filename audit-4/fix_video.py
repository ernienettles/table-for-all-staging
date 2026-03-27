import MySQLdb, json
conn = MySQLdb.connect(host="127.0.0.1", user="uw7wam3vp6ghx", passwd="wjihqutvcqr9", db="dbfjyffxpyejpa")
cur = conn.cursor()
cur.execute("SELECT meta_value FROM tnf_postmeta WHERE post_id=46633 AND meta_key=%s", ("_elementor_data",))
row = cur.fetchone()
if row:
    data = row[0]
    # Show chunk around position 2000 (where 398e467 is)
    start = max(0, 2000 - 200)
    end = min(len(data), 2000 + 500)
    print("Around position 2000:")
    print(data[start:end])
    print("---")
cur.close()
conn.close()
