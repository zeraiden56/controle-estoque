
<p align="center">
  <img src="frontend/public/goberri-markdown-header.gif" alt="Demonstração do sistema" width="300"/>
</p>

# 📦 Controle de Estoque

Sistema de controle de estoque com backend em PHP (API REST), banco de dados PostgreSQL, frontend em React e deploy com Docker + NGINX com proxy reverso. Agora com SSL habilitado!

---

## 📋 Progresso do Projeto

### 📦 1. Backend (PHP + API REST)

✅ API REST com `index.php` centralizando tudo  
✅ Autenticação via JWT  
✅ Validação de dados  
✅ Organização modular (`produtos`, `vendas`, `usuarios`)  
✅ Criação de usuários e login com JWT  
⬜ Relacionamento entre vendas e produtos  

### 🔤 2. Frontend (React + Vite + Tailwind)

✅ Tela de login conectada ao backend com JWT  
✅ Dashboard inicial funcional  
✅ CRUD de produtos  
🟡 CRUD de vendas  
⬜ Tela de relatórios/lucros  

### 🌐 3. Infraestrutura e Deploy

✅ Docker Compose com múltiplos serviços  
✅ Proxy reverso com NGINX + Certbot  
✅ SSL com Let's Encrypt para  
⬜ Deploy automático via CI/CD (planejado)

### 🤖 4. Integração com IA e WhatsApp (em breve)

⬜ Comandos de estoque via WhatsApp  
⬜ Respostas inteligentes com LLM  
⬜ Suporte a comandos por voz  

---

## 🧱 Tecnologias Utilizadas

| **Camada**         | **Tecnologia**                          |
| ------------------ | --------------------------------------- |
| **Backend**        | 🐘 PHP 8.3 + API REST                    |
| **Banco de Dados** | 🐘 PostgreSQL 15 + 🔐 pgcrypto            |
| **Frontend**       | ⚛️ React + ⚡ Vite + 🎨 TailwindCSS        |
| **Autenticação**   | 🔑 JWT (via Firebase) + 🔐 `crypt()`      |
| **Infra**          | 🐳 Docker, 🌐 NGINX, 🔒 Certbot            |
| **Hospedagem**     | 🖥️ VPS com domínio + SSL (Let's Encrypt) |

---

## 📁 Estrutura de Pastas

```bash
controle-estoque/
├── backend/
│   ├── api/
│   │   ├── auth/
│   │   ├── produtos/
│   │   ├── usuarios/
│   │   └── vendas/
│   ├── config/
│   ├── models/
│   ├── utils/
│   ├── .env
│   └── index.php
├── certbot/                         # Desafios SSL Let's Encrypt
│   ├── certbot/
│   └── letsencrypt/
├── frontend/
│   ├── public/
│   ├── src/
│   └── dist/                        # build de produção
├── nginx/default.conf               # Proxy reverso + SSL
├── docker-compose.yml
├── README.md
└── .env.example
```

---

## ⚙️ Requisitos

- PHP 8.1+
- PostgreSQL 14+
- Docker + Docker Compose
- VPS com domínio configurado
- Certbot instalado

Banco:

```sql
CREATE EXTENSION IF NOT EXISTS pgcrypto;
```

---

## 🛠️ Instalação e Deploy

### 1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/controle-estoque.git
cd controle-estoque
```

### 2. Configure variáveis de ambiente `.env`

```ini
DB_HOST=db
DB_PORT=5432
DB_NAME=controle_estoque
DB_USER=usuario
DB_PASS=sua_senha_aqui
VITE_API_URL=https://seu-dominio.com.br/api
```

### 3. Suba os containers:

```bash
docker-compose up -d --build
```

### 4. Gere o certificado SSL:

```bash
docker run --rm -v $(pwd)/certbot/letsencrypt:/etc/letsencrypt   -v $(pwd)/certbot/certbot:/var/www/certbot   certbot/certbot certonly   --webroot --webroot-path=/var/www/certbot   --email seu@email.com --agree-tos --no-eff-email   -d seu-dominio.com.br
```

### 5. Reinicie o NGINX:

```bash
docker restart nginx-estoque
```

---

## 🔐 Login (Autenticação JWT)

```http
POST /api/usuarios/
```

### Corpo da requisição:

```json
{
  "user": "usuario",
  "password": "123456"
}
```

### Resposta esperada:

```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOi...",
  "status": "success"
}
```

---

## 🚀 Acessar o Sistema

- **Produção (SSL)**: https://seu-dominio.com.br  
- **Localmente**: http://localhost:5173

---

## 🤖 Futuro: IA + WhatsApp

- IA que entende perguntas sobre o estoque  
- Conexão com WhatsApp para comandos por chat  
- IA respondendo comandos por voz/texto

---

Feito com ❤️ por uma equipe dedicada  
⬆️ `v1.1` – com SSL, login JWT e painel em React