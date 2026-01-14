# Inside your frontend Dockerfile production stage
RUN echo 'server { \
    listen 80; \
    # Serve Vue Frontend
    location / { \
        root /usr/share/nginx/html; \
        index index.html; \
        try_files $uri $uri/ /index.html; \
    } \
    # Proxy API requests to Laravel
    location /api { \
        proxy_pass http://codebranch-api:80; \
        proxy_set_header Host $host; \
        proxy_set_header X-Real-IP $remote_addr; \
    } \
}' > /etc/nginx/conf.d/default.conf