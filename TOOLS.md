# TOOLS.md - Local Notes

## Workflow Preferences

### Sub-agents for heavy lifting
**Use sub-agents liberally** so Jon stays live and available. Pattern:
- Long/parallelizable tasks → `sessions_spawn` (mode: "run")
- Sub-agent commits each feature separately as it finishes
- Jon stays in main session, responds immediately to Ernie
- Commit patterns: one feature per commit, descriptive messages

## Hardware & Network

## What Goes Here

Things like:

- Camera names and locations
- SSH hosts and aliases
- Preferred voices for TTS
- Speaker/room names
- Device nicknames
- Anything environment-specific

## Examples

```markdown
### Cameras

- living-room → Main area, 180° wide angle
- front-door → Entrance, motion-triggered

### SSH

- home-server → 192.168.1.100, user: admin

### TTS

- Preferred voice: "Nova" (warm, slightly British)
- Default speaker: Kitchen HomePod
```

## Why Separate?

Skills are shared. Your setup is yours. Keeping them apart means you can update skills without losing your notes, and share skills without leaking your infrastructure.

---

Add whatever helps you do your job. This is your cheat sheet.

### SiteGround SSH (Table for All)
Host: ssh.ernien.sg-host.com
Port: 18765
User: u2837-wmvfpoaafjg8
Key: ~/.ssh/tfa_sg_new (RSA 4096, no passphrase)
WordPress path: /home/customer/www/ernien.sg-host.com/public_html/
Theme: faith-connect-child
SCP example: scp -P 18765 -i ~/.ssh/tfa_sg_new file.txt siteground:/home/customer/www/ernien.sg-host.com/public_html/
