import tailwindcss from '@tailwindcss/vite'

/** @type {import('vite').UserConfig} */
export default {
    server: {
        origin: 'http://localhost:5173',
        cors: true,
    },
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                main: 'resources/js/app.ts',
                styes: 'resources/css/app.css'
            }
        }
    },
    plugins: [
        tailwindcss(),
        {
            name: 'reload-with-php',
            configureServer(server) {
                const { ws, watcher } = server;
                watcher.on('change', (file) => {
                    if (file.endsWith('.php') || file.endsWith('.md')) {
                        ws.send({ type: 'full-reload' });
                    }
                })
            }
        }
    ]
}