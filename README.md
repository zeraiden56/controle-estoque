
<p align="center">
  <img src="frontend/public/goberri-markdown-header.gif" alt="Demonstração do sistema" width="300"/>
</p>

# 📦 Controle de Estoque

Sistema de controle de estoque inicialmente desenvolvido com backend em PHP puro (API REST) que está sendo migrado para Laravel, com banco de dados PostgreSQL, frontend em React e deploy com Docker + NGINX com proxy reverso e SSL habilitado (Let's Encrypt).

---

## 📋 Progresso do Projeto

### 📦 1. Backend (Migração para Laravel)

✅ API REST original com `index.php` (PHP puro)  
✅ Autenticação JWT original (PHP puro)  
🟡 Migração inicial para Laravel (estrutura, migrations, models, controllers)  
⬜ Migração completa das funcionalidades para Laravel  
⬜ Integração com notificações WhatsApp (Laravel + Twilio)  

### 🔤 2. Frontend (React + Vite + Tailwind)

✅ Tela de login conectada ao backend com JWT  
✅ Dashboard inicial funcional  
✅ CRUD de produtos  
🟡 CRUD de vendas  
⬜ Tela de relatórios/lucros  
⬜ Adaptação para consumir API Laravel (planejado)

### 🌐 3. Infraestrutura e Deploy

✅ Docker Compose com múltiplos serviços  
✅ Proxy reverso com NGINX + Certbot  
✅ SSL com Let's Encrypt  
⬜ Deploy automático via CI/CD (planejado)

### 🤖 4. Integração com IA e WhatsApp (em breve)

⬜ Comandos de estoque via WhatsApp  
⬜ Respostas inteligentes com LLM  
⬜ Suporte a comandos por voz  

---

## 🧱 Tecnologias Utilizadas

| **Camada**         | **Tecnologia**                                    |
|--------------------|---------------------------------------------------|
| **Backend**        | 🐘 Laravel 11 (migrando de PHP puro)              |
| **Banco de Dados** | 🐘 PostgreSQL 15 + 🔐 pgcrypto                    |
| **Frontend**       | ⚛️ React + ⚡ Vite + 🎨 TailwindCSS                 |
| **Autenticação**   | 🔑 JWT (Laravel Sanctum/JWT-Auth)                 |
| **Infraestrutura** | 🐳 Docker, 🌐 NGINX, 🔒 Certbot                    |
| **Hospedagem**     | 🖥️ VPS com domínio + SSL (Let's Encrypt)          |

---

## 🚀 Explicação da Migração para Laravel

O projeto originalmente foi desenvolvido com PHP puro, usando PDO diretamente e JWT manual. Estamos migrando gradualmente para Laravel para maior segurança, manutenção facilitada, escalabilidade e integração rápida com outras ferramentas (WhatsApp, notificações, etc.). O frontend será adaptado após finalização da API Laravel.

---

## 🛠️ Instalação e Deploy

### Clone o repositório
```bash
git clone https://github.com/seu-usuario/controle-estoque.git
cd controle-estoque
```

### Configuração de variáveis `.env`
```ini
DB_HOST=db
DB_PORT=5432
DB_DATABASE=controle_estoque
DB_USERNAME=usuario
DB_PASSWORD=sua_senha
```

### Suba os containers com Docker Compose
```bash
docker-compose up -d --build
```

### Gere o certificado SSL
```bash
docker run --rm -v $(pwd)/certbot/letsencrypt:/etc/letsencrypt \
  -v $(pwd)/certbot/certbot:/var/www/certbot \
  certbot/certbot certonly --webroot \
  --webroot-path=/var/www/certbot --email seu@email.com \
  --agree-tos --no-eff-email -d seu-dominio.com.br
```

### Reinicie o NGINX
```bash
docker restart nginx-estoque
```

---

## 🔐 Login JWT

**Request:**
```http
POST /api/login
```

```json
{
  "email": "usuario@email.com",
  "password": "sua_senha"
}
```

**Resposta:**
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOi...",
  "status": "success"
}
```

---

## 📌 Próximos passos
- Finalizar migração backend para Laravel
- Ajustar frontend React para consumir Laravel
- Integração com WhatsApp e IA

---

Feito com ❤️ por uma equipe dedicada

⬆️ `v2.0` – Migração para Laravel iniciada.
