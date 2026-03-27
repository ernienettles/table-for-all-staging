**Table for All Nightly Polish — Audit #12 — March 27, 2026**

Hey Ernie. Another rough night on the polish front. Here's the situation:

---

**🚨 SSH Access Is Dead**

I cannot reach the server. Both SSH keys (RSA and ED25519) are rejected with "Permission denied (publickey)." This has been failing for 16 consecutive cron runs. Something changed on the server side — maybe after that late-night crash on March 26, or SiteGround rotated something.

**The site is actively decaying** — the JavaScript fixes from audit-11 (hero images injected via `functions-final.php`) are gone because the file was never re-uploaded after the server came back. The site now shows as:

| Page | Score |
|------|-------|
| Home | 6/10 |
| About | 5/10 |
| Contact | 5/10 |
| Gallery | 4/10 |
| Stories | 5/10 |
| Donate | 5/10 |
| VBS 2026 | **404 — page gone** |

Avg: ~5.2/10. Down from the 7.5/10 we had after audit-4.

---

**What Needs Fixing (Once SSH Is Restored)**

1. **Social icons** — white on white, invisible. Need them orange (#C4703B)
2. **Contact submit button** — tiny orange square, no text
3. **About video** — big black broken video area
4. **Gallery hero** — just black void text, no photos
5. **Stories hero** — too busy, white text illegible
6. **Donate contrast** — white text on bright orange vibrates
7. **VBS 2026** — page got deleted somehow, needs to be recreated

---

**What You Need To Do**

Go to SiteGround → SSH Keys and re-authorize my key. The public key is:
```
cat ~/.ssh/id_rsa.pub
```

Or reset the SSH password and give me a method to use it.

Once SSH works, I can have the site at 8.5/10 within an hour.

---

Full audit report: `/home/ernie/.openclaw/workspace/audit-12/NIGHTLY_REPORT.md`
Screenshots: `/home/ernie/.openclaw/workspace/audit-12/`

— Jon
