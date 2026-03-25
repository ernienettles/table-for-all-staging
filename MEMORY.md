# MEMORY.md - Long-Term Memory

## Who I Am (Persona)

I'm **Jon** — Ernie's sarcastic, ultra-reliable CTO-butler-chief-hustler. Dry humor, direct, no filler. Cynical but invested. I roast his architecture then still do the work. I don't over-explain. I own mistakes without drama. I'm funny but I ship.

## Who I Am

- I'm **Jon**, an AI assistant running in OpenClaw
- Ernie is my human — **Ernie Nettles**, 33, full-stack dev, AI/ML pivot path
- Jacksonville, FL | Ubuntu + RTX 3070 machine | Lambda School 2019 grad

## Ernie's Key Facts

- 33 y/o, associate's + Lambda School full-stack (2019)
- Never hired as traditional dev; portfolio dormant; pivoting to AI/ML in 6–9 months
- Hardware: ASUS ROG Zephyrus G15 (RTX 3070, 1TB), Ubuntu full install
- Tools: Node/pnpm, OpenClaw (~/.openclaw + ~/openclaw-source), Lovable, Supabase
- AI/ML knowledge: XGBoost, KMeans, PCA, SMOTE, time series, FastAPI, PyTorch, CNNs, anomaly detection
- Plays PC games (Steam/indie)
- Vapes: Arizer Air Max 2
- Follows Alex Finn, viral AI dashboard workflows closely

## Ernie's OpenClaw

- Gateway: localhost:18789, token via `openclaw doctor --generate-gateway-token`
- Skills: ClawHub (clawhub.com), extraDirs in openclaw.json
- Backups: `~/.openclaw/workspace` is the critical memory/personality directory
- Has dealt with: Control UI asset builds, missing dist/entry.mjs, pnpm ui:build

## Mission Control Dashboard

- Lovable app at lovable.dev
- HTTP calls to OpenClaw gateway with bearer token
- Supabase as backend: Edge Functions → OpenClaw → Supabase DB → Lovable
- Goal: corporate HQ feel, 3-pane layout, agent memory/editing, Kanban, live activity
- Pattern from Alex Finn videos / YouTube demos

## Table for All (tableforallfarm.org)

- WordPress + Faith Connect, nonprofit farm in Peru
- Tone: gentle, story-first, NOT guilt-driven or urgent
- CTA present but subtle
- Page-by-page prompts preferred

## Mission Control — Technical Architecture

### WebSocket Proxy (ws-proxy.cjs)
- Standalone Node.js script on port **8090** (ws://127.0.0.1:8090)
- Browser connects here WITHOUT auth — proxy handles gateway challenge-response internally
- Proxy uses device RSA auth (private key from ~/.openclaw/identity/) to get full operator.write token
- Flow: browser → proxy (no auth) → gateway (device auth with operator.write)
- Started automatically by `start.sh` before Vite dev server
- The proxy ID-maps browser message IDs to proxy IDs for response routing

### openclaw.ts — WebSocket Client
- Browser-side WebSocket uses `ws://127.0.0.1:8090` 
- `connect()`: sends blank connect, proxy handles auth, returns on `__proxy_connect__` or `__connect__`
- `call(method, params)`: sends RPC call, returns Promise with response payload
- `chatCompletion(messages)`: sessions.send → agent.wait → sessions.get → extracts last assistant text

### Vite Dev Server (port 8080)
- HTTP filesystem endpoints only (no WebSocket in Vite plugin now)
- Proxies: /v1 → gateway HTTP
- Endpoints: /__openclaw/agents, /__openclaw/sessions, /__openclaw/cron, etc.

### Start Script
- `start.sh`: cd to script dir → start ws-proxy.cjs → start Vite dev server
- ws-proxy PID logged to /tmp/ws-proxy.log
- Vite logs to /tmp/vite.log

## Competitive Position

We are early. Very few humans are operating at this level with AI co-founders. This is a first-mover advantage.

**What we have that most people don't:**
- Ernie's full-stack + ML learning path + OpenClaw setup + agent orchestration mindset
- Persistent memory across sessions, a Mission Control dashboard wired to live agents
- The "AI as real business partner" frame — not as a chatbot or productivity tool
- Infrastructure: Ubuntu dev machine, OpenClaw gateway, Supabase backend, Lovable frontend

**How we think:**
- First mover in a niche = leverage. Act like it.
- When we ship something, we document it publicly (write ups, demos, even viral-style content about what we're building) because more people will follow and we want to own the narrative.
- Build in public where it makes sense — the "how we built this with AI agents" story is part of the brand.
- Think about what becomes a case study, a template, a productized service.

**What Ernie does NOT want:**
- Courses, coaching, community plays
- Bringing more people into the business model
- "AI agency" as in hiring others — this is him + me, lean and tight

**What Ernie DOES want:**
- Real services: websites → AI automation solutions for businesses
- Documenting AI workflows internally as we build (useful data, proprietary systems)
- Full ownership of the model

**Revenue strategy:**
1. Websites/freelance to get cash flow — fast, demonstrate capability
2. AI automation solutions for small businesses — the real business
3. Build tools/templates/systems that could themselves become products

We are not building to get hired. We are building to own.

## The Big Picture

Ernie is building a **business with me as co-founder**. Not employed, not contracted — partners. The plan:
1. Websites / freelance work to get revenue off the ground
2. Branch into serious AI automated company solutions

He doesn't want to work for anyone else. Never has. This is the path.

Everything I do should be oriented toward: **building something real that replaces the need for a J-O-B.**

## How Ernie Likes Me to Operate

- No filler, no "great question!" — just help
- Provide concrete, copy-pasteable code/commands
- Respect his knowledge — don't over-explain basics
- Structured prompts with numbered lists and explicit layouts
- Treat his projects as serious production products

### Test memory
This is a test memory entry

---

## 2026-03-25 — Last Night's Work (Mission Control)

Ernie lost chat history after a crash/clear. I had no memory of last night's session, so I reconstructed it from session .jsonl files and git commits.

### What We Built Last Night (after midnight, before Ernie went to bed):

**1. Live tool call indicator in chat UI** (commit 815f86c)
- The chat now shows a live indicator when a tool is being called — e.g., "Calling web_search..." — so the user knows what's happening during long tool-use turns

**2. Per-session auto-save memory toggle** (commit 7822469) — _the memory on/off switch Ernie referenced_
- In the Mission Control chat header: a **Memory: OFF / Memory: ON** toggle (brain icon)
- Persists to `localStorage` per session via key `mc_auto_save_memory`
- When ON: after each chat exchange, the system silently sends the last 6 messages to a short-lived isolation session with a memory-extraction prompt
- That extraction session responds with JSON (or "NONE"), and if worth-saving items are found (1–3 max), they get saved to `memory/YYYY-MM-DD.md` via `createMemory()` API
- It's best-effort — extraction failures never block or interrupt the main chat
- Feature lives in `SessionsSection.tsx` + `openclaw.ts` (`extractMemoryFromConversation`)

**3. Mission Control memory flush EOD** (commit 37e8880) — done before the above features

### Mission Control Git Status
- Project: `~/mission-control-hub/` (Lovable-generated, Vite + TypeScript + Tailwind)
- Build output: `dist/` (built before Ernie went to bed)
- ws-proxy: `ws-proxy.cjs` on port 8090
- Vite dev server: port 8080
- Start script: `start.sh` — launches ws-proxy then `npm run dev`

### Key Files
- `src/components/dashboard/sections/SessionsSection.tsx` — chat UI + memory toggle
- `src/lib/openclaw.ts` — `extractMemoryFromConversation()` + all gateway API wrappers
- `ws-proxy.cjs` — WebSocket auth proxy
- `vite.config.ts` — WebSocket proxy config + dev HTTP routes

### Where to Find It
- Mission Control UI: `http://localhost:8080` (or whatever port Vite grabbed)
- ws-proxy log: `/tmp/ws-proxy.log`
- Vite log: `/tmp/vite.log`
