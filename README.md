# Aderência escolar / gestão (TR 5.3)

Pacote Buriti para o i-Educar **2.12** — fecha gaps Laguna (gabarito, uniforme, marca d’água, fluxo PoC).

Composer: `buriti/i-educar-escolar-aderencia-package`  
Repo: https://github.com/i-Educar/i-educar-escolar-aderencia-package

## Compatibilidade

| Produto | Versão |
| --- | --- |
| **i-Educar** | **2.12.x** (min. 2.12.0) |
| **i-Diário** | Portabilis i-Diário (espelho Laguna) via API/SSO do core |
| Pacote | `0.2.0` |

Declarado em `composer.json` → `extra.ieducar` e `extra.idiario`.

## Onda 1

```bash
php packages/buriti/i-educar-escolar-aderencia-package/tests/run.php
php artisan escolar:onda1-demo
# artefatos em storage/app/escolar-onda1/
```

## Documentos

- `EPIC.md` · `ROADMAP.md` · `TODO.md` · `REQUISITOS-TR.md`
- `docs/onda-1/MATRIZ-POC.md`
