# ===========================================
# Nginx Dockerfile
# ===========================================

FROM nginx:alpine

# Nginx設定をコピー
COPY docker/nginx/default.prod.conf /etc/nginx/conf.d/default.conf

# 静的ファイルをコピー（CSS, JS, 画像など）
COPY --chown=nginx:nginx public /var/www/public

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
