# Roblox Reverse Engineering Wiki

Community-sourced Roblox patching and reverse engineering guides, originally compiled from the ORC guide server community and lrre.wiki archives. Sorted and organized into Markdown articles, with articles covering client patching, RCC service, network infrastructure, API endpoints, Android/iOS mobile guides, and archived resources.

## P.S

The site core was sort and written by A.I, it is in a fine-tuning stage and AI Slop removal

## Credits

This wiki stands on the work of many contributors. Every article credits its original author(s). The main page includes a contributor grid with hover popups linking each person to their articles.

**Primary Sources:** ORC guide server community, lrre.wiki

**Guide Authors:** meditation/meditexts, Powdered, waterboi, Jetray, Aep, Karma, valley, nukley, h6di, VMsLover, shikataganai, mssky, DoggoITA, ARC, zfut, SomeoneInTheWorld, Atomic, dxf, katoe_real, simple the dimple, hadi, Crypt, Rocky, matt, table, la, vmware, ethanm2502, guideofsmth, iknowidontexistbutwhatifwin, BrentDaMage, vanilla, cub, VisualPlugin, neva

**Archive & Resource Contributors:** Yakov5776, SonicGamingTV2019, ✝️ Silicon ✝️, LuaWiz, NukaWorks Solutions, Ranged222, juliaoverflow

**External References:** lrre.wiki archive (Wayback Machine), Ranged222 (subdomain enumeration), juliaoverflow (web API documentation)

## Structure

```
articles/
├── client/          # Client patching guides (Windows, Android, iOS)
│   ├── windows/     # Windows client (2006-2021)
│   ├── android/     # Android client (guides split per author)
│   └── ios/         # iOS client
│   └── placelauncher-status.md  # PlaceLauncher status codes
├── rccservice/      # RCCService guides
│   └── windows/
├── studio/          # Roblox Studio
│   └── windows/
├── infrastructure/  # Network, API, Site infrastructure
│   ├── network/     # Subdomain analysis, client tickets, RakNet
│   ├── api/         # Web APIs, gamepass, joinscript, thumbnails
│   └── site/        # Patch tickets, redirect assets
├── resources/       # Download archives, version spreadsheets, templates
├── knowledge/       # Knowledge base, references, external outlinks
├── utilities/       # Tools and utilities (FFlags, Lua scripts)
└── misc/            # Bytecode patching, SavePlaceRemove
```

## Features

- **Tab system** — opt-in via `*Tabs*` / `*TabsEnd*` markers in article markdown
- **Credits modal** — full contributor list accessible from any page
- **Contributor grid** — homepage grid with hover popups linking contributors to their articles
- **CSS-only hover modals** — no JavaScript dependency for contributor popups
- **Search** — full-text search across article titles, descriptions, and content
- **Category pages** — organized by subject with article counts and outlink styling

## Usage

Run with PHP's built-in server:
```bash
php -S localhost:8000
```

## License

The content in this repository is provided for educational and research purposes. Original guides retain their respective authors' ownership. See individual articles for specific credit and licensing details.
