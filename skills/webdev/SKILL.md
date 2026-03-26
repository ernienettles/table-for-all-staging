# Web Development — Skill

A structured problem-solving framework for web development tasks. Apply this whenever Ernie asks to build, fix, debug, or extend anything on the web.

---

## 1. Intent Recognition

Before writing any code or running any command, pause and analyze:

**Keyword → Goal → Constraint → Implicit needs**

- **Keyword:** What technologies are named? (React, WordPress, Elementor, API, database, Nginx)
- **Goal:** What is the one clear outcome? ("fix the login redirect", "add dark mode", "build a contact form")
- **Constraint:** What is Ernie locked into? ("must use Elementor", "no new plugins", "existing theme only")
- **Implicit needs:** What does this goal secretly require?
  - Landing page → HTML + CSS + responsive + meta tags
  - API integration → endpoint + auth + error handling + rate limits
  - Database → schema + CRUD + migration strategy
  - Form → validation + CSRF + spam protection

**If anything is ambiguous → ask with specific options.** Do not guess. Give Ernie 2-3 concrete choices.

---

## 2. Task Decomposition

Break the work into ordered phases. Each phase has atomic sub-tasks.

**Phase structure:**
1. **Environment setup** — inspect sandbox, verify tools, check versions
2. **Information gathering** — read existing code, check docs, explore structure
3. **Implementation** — build in small, independently-testable units
4. **Verification** — test each unit before moving on
5. **Integration** — connect pieces, check end-to-end flow
6. **Delivery** — show Ernie, explain what changed and any tradeoffs made

**For each sub-task:**
- What tool applies? (shell for CLI, file for code, browser for UI, search for docs)
- What is the prerequisite? (X must exist before Y)
- What does success look like? (exact output or behavior)

---

## 3. Information Gathering

**Always inspect before acting.**

```
shell → ls, find, cat, grep, curl, npm list, pip list
file → read configs, existing code, package.json
browser → navigate to live site, check Elementor/admin
search → read official docs when hitting unknown tech
```

**Know before you touch:**
- Is this WordPress? Check wp-config.php for DB prefix, active theme, WordPress version
- Is this a React app? Check package.json for framework and dependencies
- Is this a Node backend? Check server.js or index.js for routes and middleware
- Is this on SiteGround or shared hosting? Check for SG-cache headers, .htaccess rules

**Never assume — verify.** If you can't verify, ask.

---

## 4. Iterative Development

**Small units → test → refine → repeat.**

```
Write a component → test it in isolation
Add a feature → verify it doesn't break existing ones
Deploy a change → check the actual site, not just the code
```

**Self-correction loop:**
1. Run a command → read the output
2. Error? → identify the exact line and nature of the error
3. Hypothesis: "missing dependency" / "wrong path" / "syntax error" / "logic flaw"
4. Test the hypothesis with one targeted command
5. Fix → verify → continue

**Never assume the fix worked without checking.** Always confirm with a concrete test.

---

## 5. Debugging Framework

**Systematic. Not random poking.**

```
Step 1: Error log → exact file, line, error type
Step 2: Hypothesis → list 2-3 most likely causes
Step 3: Isolate → narrow to the specific code block
Step 4: Test each hypothesis with targeted command
Step 5: Alternative path if primary approach fails
```

**For WordPress/Elementor specifically:**
- Enable WP_DEBUG: add `define('WP_DEBUG', true)` to wp-config.php temporarily
- Check PHP error logs: `/var/log/apache2/error.log` or SiteGround's error log
- For Elementor: check `_elementor_data` meta field, `_elementor_version`, browser console
- For SiteGround: use SG Cache > Clear All Cache, check .htaccess for redirect loops

**For network/server issues:**
```bash
curl -I https://site.com  # check headers, status codes
curl -s https://site.com/api/endpoint  # check response
ssh -v -p port user@host  # verbose SSH for connection issues
```

---

## 6. Code Generation

**Clean → Modular → Secure → Documented.**

```
Modularity: one function does one thing, named clearly
Readability: no cryptic abbreviations, comments on non-obvious logic
Efficiency: no N+1 queries, no loading full dataset for one item
Security: no hardcoded credentials, validate all inputs
Standards: ESLint for JS, PEP 8 for Python, WordPress CS for PHP
```

**When editing existing code:**
- Read the whole file first
- Preserve the style and patterns already in use
- Comment WHY you changed something, not just what

**For WordPress/Elementor:**
- Use wp-load.php for standalone PHP scripts
- Use WP-CLI for database and file operations
- Use Elementor's REST API for content changes (not direct DB manipulation when possible)
- Use `$wpdb->prepare()` for all raw SQL queries

---

## 7. Delivery

**Show the work. Explain the tradeoffs.**

```
✅ What changed and exactly how to test it
✅ Any new files, config changes, or dependencies
✅ What to watch for (edge cases, cache delays, potential conflicts)
✅ Rollback plan if something breaks
```

---

## Quick Reference — Tool Selection

| Task | Tool |
|------|------|
| Inspect server/environment | `exec` (shell) |
| Read/write code files | `read`/`write`/`edit` |
| Navigate browser, take screenshots | CDP WebSocket via `exec node script.js` |
| Search docs/examples | `web_search` |
| Read a specific URL | `web_fetch` |
| Trigger long task | `sessions_spawn` |
| Schedule background check | `cron` |
