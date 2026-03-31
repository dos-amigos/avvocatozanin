---
name: Always add width 100% to flex children with container class
description: Flex children with .container class need width:100% or they don't stretch, causing centering bugs
type: feedback
---

When a flex parent (display: flex) contains a child with the `.container` class (which has margin-inline: auto), the child does NOT stretch to full width by default. It stays at content width and margin-inline: auto centers it incorrectly.

**Why:** This caused the hero text alignment bug on EVERY page — text appeared centered instead of aligned with the header. Had to fix it 4 times across homepage, chi-sono, come-lavoro, contatti.
**How to apply:** ALWAYS add `width: 100%` to any `.container` element that is a direct child of a flex parent. Check ALL page-specific CSS files when fixing this pattern — don't fix just one page.
