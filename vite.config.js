import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ mode }) => {
    // Carrega as variáveis do arquivo .env (o terceiro parâmetro '' permite ler variáveis sem o prefixo VITE_)
    const env = loadEnv(mode, process.cwd(), '');

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/css/cardapio.css', 'resources/css/radape.css', 'resources/js/app.js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
        server: {
            host: '0.0.0.0',
            port: 5173,
            hmr: {
                protocol: 'ws',
                host: env.IP, // Agora a variável será lida corretamente do seu .env
            }
        }
    };
});
