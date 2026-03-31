---
name: Fix issues across ALL pages at once, not one by one
description: When fixing a CSS pattern bug, apply the fix to every page immediately — user gets furious when the same bug appears on another page
type: feedback
---

When a CSS fix applies to a shared pattern (like .page-hero__content), grep for ALL instances across ALL page-specific CSS files and fix them ALL in one commit. Do not fix one page and wait for the user to find the same bug on another.

**Why:** User had to report the same page-hero alignment bug 3 separate times (chi-sono, come-lavoro, contatti). Each time was frustrating.
**How to apply:** After any CSS fix, immediately grep for the same selector/pattern in all CSS files and apply the fix everywhere. One commit, all pages.
