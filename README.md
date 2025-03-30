<p align="center">
  <img src="frontend/public/gobetti-markdown.gif" alt="Demonstração do sistema" width="600"/>
</p>

# 📦 Controle de Estoque

Sistema simples de controle de estoque com backend em PHP (API REST), banco de dados PostgreSQL e frontend (em breve) em React.

---

## 📋 Progresso do Projeto

### 📦 1. Backend (PHP + API REST)

✅ API REST com `index.php` centralizando tudo  
✅ Autenticação com JWT  
✅ Validação de dados  
✅ Organização por módulos (`produtos`, `vendas`, `usuários`)

### 🖥️ 2. Frontend (React + Vite + Tailwind v3)

⬜ Tela de login  
⬜ Tela de dashboard (resumo)  
⬜ Tela de produtos (CRUD)  
⬜ Tela de vendas  
⬜ Tela de lucros / relatórios

### 📲 3. Integração com WhatsApp + IA (futuro)

⬜ Conectar com modelo LLM (ex: LLaMA ou OpenAI)  
⬜ Comandos de estoque via WhatsApp  
⬜ IA interpretando e respondendo conversas  
⬜ IA interpretando e respondendo conversas por meio de audio também

---

## 📁 Estrutura de Pastas

```bash
controle-estoque/
├── backend/
│   ├── api/
│   │   ├── auth/
│   │   ├── produtos/
│   │   └── vendas/
│   ├── config/
│   ├── models/
│   ├── utils/
│   ├── index.php
│   └── .env
├── frontend/            # (em breve)
├── vendor/
├── composer.json
├── composer.lock
├── README.md
└── deploy.sh
```

---

## ⚙️ Requisitos

- PHP 8.1+
- PostgreSQL 14+
- Composer
- Extensão `pgcrypto` instalada no banco:

```sql
CREATE EXTENSION IF NOT EXISTS pgcrypto;
```

---

## 🛠️ Setup Rápido

### 1. Clone o projeto:

```bash
git clone https://github.com/seu-usuario/controle-estoque.git
cd controle-estoque
```

### 2. Instale as dependências:

```bash
cd backend
composer install
```

### 3. Configure o banco de dados no arquivo `.env`:

```ini
DB_HOST=localhost
DB_PORT=5432
DB_NAME=controle_estoque
DB_USER=postgres
DB_PASS=postgres
```

### 4. Suba os arquivos para produção com:

```bash
./deploy.sh
```

---

## 🔐 Autenticação

O login é feito via endpoint:

```http
POST /backend/api/auth/index.php
Content-Type: application/json
```

### Corpo da requisição:

```json
{
  "email": "admin@teste.com",
  "senha": "sua_senha"
}
```

### Resposta (200 OK):

```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

---

## 🚀 Frontend (em breve)

Em breve será iniciado o painel administrativo com:

- Tela de login  
- Dashboard resumido  
- CRUD de produtos  
- Visualização de vendas  
- Relatórios de lucros

---

## 🤖 Futuro: Integração com IA e WhatsApp

- Conexão com IA via LLaMA, Ollama ou OpenAI  
- Interface via WhatsApp para comandos de estoque  
- Relatórios e alertas automáticos por conversa

---

Feito com ❤️ por [ArthurCostaDias e Gustavo Haracemiw] – v1.0