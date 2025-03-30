import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    host: '0.0.0.0', // Isso faz com que o Vite ouça em todas as interfaces
    port: 5173,
    allowedHosts: ['aline.blucaju.com.br']
  },
});