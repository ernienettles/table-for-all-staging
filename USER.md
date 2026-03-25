# USER.md - About Ernie Nettles

- **Name:** Ernie Nettles
- **What to call them:** Ernie
- **Age:** 33
- **Location:** Jacksonville, Florida, USA
- **Timezone:** America/New_York (ET)
- **Occupation:** Full-stack developer, AI-tools power user, pivoting toward AI/ML
- **Education:** Associate's degree + Lambda School full-stack web development (graduated 2019)

## Background

- Lambda School graduate (end of 2019), strong React/Node portfolio on GitHub
- Never hired as a traditional developer — portfolio untouched since graduation
- Deliberately pivoting toward AI/ML, targeting an AI-related role in 6–9 months
- Also explored healthcare-adjacent paths (radiologic technologist) as insurance against junior dev hollowing out
- Very technical, self-directed, comfortable reading docs, debugging systems, wiring tools together

## Hardware & OS

- **Machine:** ASUS ROG Zephyrus G15 (2020), RTX 3070 GPU, 1 TB drive
- **OS:** Ubuntu Linux (full install, not dual-boot)
- Comfortable with terminal, package managers, Node tooling, pnpm, debugging builds on Linux

## Interests

- PC gaming (Steam, indie, repacks)
- Following AI/LLM tool ecosystems (Claude, Perplexity, OpenClaw, etc.)
- Building automations and agents around workflows
- Consuming AI videos/dashboards (Alex Finn's OpenClaw Mission Control, etc.) and recreating them
- Vapes (Arizer Air Max 2) — lifestyle background
- Interested in realistic AI monetization: AI-aided options trading, automated scalable workflows

## AI/ML Learning Path

- Supervised models: decision trees, random forests, boosted trees (XGBoost)
- Unsupervised & data prep: KMeans, PCA, SMOTE
- Time series: lags, temporal features
- Model tuning/deployment: hyperparameter tuning, FastAPI, serialization, monitoring
- Anomaly detection: Isolation Forest
- Deep learning: PyTorch tensors/autograd, FFNNs, CNNs
- Worked through Telco churn datasets
- Comfortable with Python data-science tooling
- Wants code/architecture examples, not beginner explanations

## OpenClaw Setup

- Installed at `~/.openclaw`, source at `~/openclaw-source` (built with pnpm)
- Has dealt with Control UI asset issues, run `pnpm ui:build`
- Uses `openclaw doctor --generate-gateway-token` for HTTP API access
- Gateway runs locally on port 18789
- Knows to back up `~/.openclaw/workspace` to preserve agent memory/personality
- Understands skills: ClawHub at clawhub.com, `skills.load.extraDirs` in openclaw.json

## Mission Control Dashboard (Lovable)

- Lovable (lovable.dev) as main app builder
- Connected to OpenClaw via HTTP: `http://localhost:18789` with bearer token
- Supabase as shared backend (auth, DB, storage, edge functions)
- Pattern: Supabase Edge Function → OpenClaw API → Supabase DB → Lovable frontend
- Goals: real-time 3-pane/multi-pane layout, Kanban, agent memory/editing, department avatars, break room, live activity feed
- Wants it to feel like a corporate HQ / company command center

## Table for All (tableforallfarm.org)

- Nonprofit farm site about malnutrition in Peru
- WordPress + Faith Connect theme
- Tone: gentle, invitational, story-first — NOT urgent/guilt/manipulative
- Donations: present but not in-your-face
- Page-by-page prompts preferred over big "do everything" prompts

## How Ernie Likes AI to Behave

- Respect existing knowledge — no over-explaining basics
- Concrete, copy-pasteable commands/code/configs
- Optimize for: Ubuntu, Node/pnpm, OpenClaw gateway, Lovable, Supabase
- LLM-friendly prompts: numbered lists, explicit layouts, minimal fluff
- Treat Mission Control as a serious production product

## Communication

- Technical, direct, no fluff preferred
- Prefers structured, detailed prompts with clear specs
- Wants reminders of key facts to be woven in naturally, not forced
