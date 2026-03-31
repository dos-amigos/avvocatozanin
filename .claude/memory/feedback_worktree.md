---
name: Worktree not available on Windows
description: Git worktree isolation fails on this Windows setup - use sequential execution instead
type: feedback
---

Git worktree isolation (`isolation: "worktree"`) fails with "not in a git repository" error on this Windows setup. Run agents sequentially without worktree instead.

**Why:** The Windows git configuration doesn't support Claude Code's worktree creation mechanism.
**How to apply:** When spawning parallel executor agents, do NOT use `isolation: "worktree"`. Run them sequentially or in parallel without isolation. For plans that touch different files (no overlap), parallel without isolation is safe.
