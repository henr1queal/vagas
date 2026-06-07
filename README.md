# Vagas Maceió

Plataforma web de **publicação e gestão de vagas de emprego** focada em Maceió/AL. Empresas cadastram vagas, pagam para publicar e acompanham candidatos; candidatos se inscrevem por formulário ou envio de currículo.

> Projeto em **Laravel 10 (PHP 8.2).**

---

## O que o sistema faz

### Para empresas / recrutadores

- Cadastro com dados da empresa (CNPJ, telefone, razão social)
- Publicação de vagas com planos **Normal** e **Destaque**
- Painel com status: pagamento pendente, aguardando aprovação, ativa ou expirada
- Edição de vaga, pré-visualização e renovação
- Gestão de candidatos por vaga (formulário estruturado ou currículo em PDF)
- Notificações por e-mail (novos currículos, visualizações da vaga)
- Pagamento integrado via **Mercado Pago**

### Para candidatos

- Listagem pública de vagas com filtros (tipo de contrato, jornada, modalidade)
- Página da vaga com dois fluxos de candidatura:
  - **Upload de currículo** (PDF/DOC)
  - **Formulário completo** (experiências, disponibilidade, dados pessoais)
- Validação de telefone brasileiro e reCAPTCHA v3

### Para administradores

- Aprovação de vagas pagas antes de irem ao ar
- Visão ampliada no site (vagas de todos os anunciantes)
- Rotas exclusivas do usuário admin (`id = 1`)

---

## Stack técnica

| Camada | Tecnologias |
|--------|-------------|
| Backend | PHP 8.2, Laravel 10, Eloquent ORM |
| Frontend | Blade, Bootstrap 5, Sass, Vite, Alpine.js |
| Banco | MySQL 8 |
| Pagamentos | Mercado Pago SDK |
| E-mail | SMTP (Mailpit em desenvolvimento) |
| Infra local | Docker, Nginx, PHP-FPM |
| Qualidade | PHPUnit, Laravel Pint, Factories & Seeders |
| Outros | Laravel Sanctum, validação PT-BR, filas, cache |

---

## Destaques para avaliação técnica

- **Arquitetura MVC** com controllers enxutos, models com relacionamentos e regras de validação customizadas
- **Fluxo completo de negócio**: cadastro → pagamento → moderação → publicação → candidatura → painel
- **Integração de pagamento** com webhook Mercado Pago
- **Upload seguro de arquivos** com armazenamento em `storage/app/curriculos`
- **Cache** na listagem pública de vagas para performance
- **Jobs e comandos Artisan** para envio diário de currículos por e-mail
- **Ambiente reproduzível** com Docker Compose (app, nginx, MySQL, Mailpit)
- **Dados de demonstração** via `DemoSeeder` (admin, vagas e candidatos fictícios)

---

## Estrutura do projeto

```
app/
├── Http/Controllers/     # Vagas, candidatos, pagamentos, auth
├── Models/               # User, Vacancy, Candidate, ...
├── Mail/                 # E-mails transacionais
├── Jobs/                 # Processamento assíncrono
└── Rules/                # reCAPTCHA, validações customizadas

resources/views/          # Templates Blade (UI pública e painel)
database/
├── migrations/           # Schema MySQL
├── factories/            # Geração de dados fake
└── seeders/              # DemoSeeder (ambiente de demonstração)

docker/                   # Nginx, PHP, entrypoint
```

---

## Rodando localmente (Docker)

**Requisitos:** Docker e Docker Compose.

```bash
docker compose up --build
```

| Serviço | URL |
|---------|-----|
| Aplicação | http://localhost:8080 |
| Mailpit (e-mails) | http://localhost:8025 |
| MySQL | `localhost:3306` |

Na primeira execução, o container instala dependências, gera a `APP_KEY`, compila assets e executa as migrations.

### Popular com dados de demonstração

```bash
docker compose exec app php artisan db:seed --class=DemoSeeder
```

**Credenciais do admin (painel + aprovação de vagas):**

| Campo | Valor |
|-------|--------|
| E-mail | `admin@vagasmaceio.test` |
| Senha | `VagasAdmin@2026` |

**Empresa de exemplo:**

| Campo | Valor |
|-------|--------|
| E-mail | `empresa@vagasmaceio.test` |
| Senha | `Empresa@2026` |

Após o seed: acesse `/login` → `/painel` para ver vagas e candidatos.

### Comandos úteis

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan cache:clear
docker compose exec app php artisan tinker
docker compose down          # parar
docker compose down -v       # parar e apagar banco
```

---

## Variáveis de ambiente relevantes

Copie `.env.example` para `.env` e configure conforme necessário:

- `APP_URL` — URL base da aplicação
- `DB_*` — conexão MySQL (já ajustado para Docker)
- `MP_ACCESS_TOKEN` / `MP_PUBLIC_KEY` — Mercado Pago
- `MAIL_*` — envio de e-mails
- Chaves do reCAPTCHA v3 (usadas nas candidaturas)

---

## Licença

MIT
