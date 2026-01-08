# Phony Branding Guidelines

This document defines the **final, approved brand identity** for **Phony** — a PHP developer tool orchestrator. It explains *what Phony is*, *why it is called Phony*, and *how the brand must be represented* visually and verbally.

This is the **single source of truth** for branding decisions.

---

## Brand Overview

| Attribute      | Value                       |
|----------------|-----------------------------|
| **Name**       | Phony                       |
| **Package**    | `wayofdev/phony`            |
| **Namespace**  | `WayOfDev\\Phony`           |
| **Binary**     | `phony`                     |
| **Repository** | `github.com/wayofdev/phony` |

---

## Brand Rationale: Why “Phony”?

The name **Phony** is intentionally ironic.

At first glance, Phony looks like a single CLI tool. In reality, it is an **orchestrator** — a facade that coordinates multiple best-in-class PHP quality tools behind one simple interface.

In this sense, Phony is *“phony”* in the same way many software abstractions are:

> it presents a simplified surface while hiding real complexity underneath.

This deliberate illusion is a **feature, not a flaw**.

Phony does not replace existing tools —
it *pretends* to be one tool so developers don’t have to think about many.

This mirrors familiar software concepts:

* Facade pattern
* Adapter
* Proxy
* Unified interface over complex systems

The name rewards curiosity: once understood, it feels *earned*.

---

## Brand Mantra

> **One stable. One command. Trusted PHP quality.**

Alternative internal phrasing (not for logo use):

* *A friendly facade over serious tooling*
* *Simple on the surface. Powerful underneath.*

---

## Mental Model (ASCII)

This is how Phony should be understood architecturally and conceptually:

```text
┌──────────────┐
│    phony     │   ← one command, one interface
└──────┬───────┘
       │
       ▼
┌──────────────────────────────┐
│  linters • formatters • SAST │
│  analyzers • custom checks  │
│  best-in-class PHP tools    │
└──────────────────────────────┘
```

Phony is the **stable master**, not the horse.

---

## Mascot (FINAL)

### Concept

**Illustrated / plush elephant–pony hybrid** inspired by the official PHP **elePHPant** mascot.

* Elephant head → PHP heritage
* Pony body → speed, elegance, agility
* Hybrid → intentional abstraction

This mascot is **not realistic**. It is friendly, symbolic, and recognizably PHP-native.

### Anatomy

* **Head:** Elephant-like, short rounded trunk, big friendly eyes, round ears
* **Body:** Compact pony body, plush proportions
* **Pose:** One front hoof slightly raised (confidence + friendliness)
* **Mane & Tail:** Flowing, stylized, adds motion

---

## Color Palette (FINAL)

| Usage           | Hex                         |
|-----------------|-----------------------------|
| Primary body    | `#777BB4` (PHP purple-blue) |
| Body shading    | darker purple tones         |
| Mane & tail     | `#CD853F` → `#DAA520`       |
| Eyes            | `#FFFFFF` + dark pupils     |
| Text (light UI) | `#333333`                   |
| Text (dark UI)  | `#E6EDF3`                   |

---

## Logo System

### Composition

* Mascot on the **left**
* Wordmark **“Phony”** on the right
* Optional tagline below

### Geometry Rule (MANDATORY)

The tagline must align **exactly under the left edge of the “P”** in “Phony”.

```text
P h o n y
|
Your PHP quality stable
```

No centering by eye. This is a hard alignment rule.

---

## Tagline

**Primary tagline:**

> **Your PHP quality stable**

Meaning:

* *Stable (noun)* — a collection of tools
* *Stable (adjective)* — reliable, trustworthy quality

The tagline is **optional** and only used in full logo variants.

---

## Theme Variants (GitHub)

Two official variants are required.

### Light Theme

* Optimized for white backgrounds
* Tagline text: dark gray (`#333333`) or deep purple-gray

### Dark Theme

* Optimized for GitHub dark (`#0d1117`)
* Tagline text: near-white (`#E6EDF3`)
* Purple tones slightly brightened for contrast

No glow, no background fills.

---

## Canonical Logo Generation Prompt (LOCKED)

```text
Create a high-quality illustrated mascot logo for a PHP developer CLI tool named “Phony”
(PHP + Pony = Phony). Output with a fully transparent background (alpha).

Mascot (left):
- Cute elephant–pony hybrid inspired by the PHP elePHPant plush style
- Elephant head, short rounded trunk, big friendly eyes, round ears
- Compact pony body, plush proportions, one front hoof slightly raised
- Flowing mane and tail with motion

Colors:
- Body: PHP purple-blue (#777BB4) with darker purple shading
- Mane & tail: warm chestnut / amber (#CD853F to #DAA520)
- Eyes: white with dark pupils and highlight

Wordmark (right):
- Text: “Phony”
- Bold modern developer-friendly typography
- Two-tone: “Ph” in purple, “ony” in warm chestnut/orange

Tagline (optional second line):
- “Your PHP quality stable”
- MUST align exactly under the left edge of the “P” in “Phony”

Composition:
- Mascot left, wordmark right, tagline below
- Transparent background only
- Crisp edges suitable for SVG redraw
```

---

## Asset Naming Convention

```text
assets/
├── logo.svg
├── logo.gh-light-mode-only.svg
├── logo.gh-dark-mode-only.svg
├── logo-icon.svg
├── logo-icon-512.png
├── favicon.ico
└── social-preview.png
```

---

## README.md Structure (Recommended)

The README should reinforce the brand narrative:

1. **Logo (auto light/dark switch)**
2. **One-sentence value proposition**
3. **Short explanation of “phony” (facade metaphor)**
4. **What Phony does / does not do**
5. **Quick start**
6. **Tool ecosystem (what it orchestrates)**
7. **Configuration philosophy**
8. **Contributing & design principles**

---

## Brand Positioning Summary

Phony is:

* Friendly, not corporate
* Honest about abstraction
* PHP-native, not generic
* Simple on the surface, serious underneath

> **Phony is a deliberate illusion — built to make PHP quality boringly reliable.**
