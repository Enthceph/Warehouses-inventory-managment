FROM node:20.11.1

WORKDIR /var/www/laravel

# EXPOSE 5173

RUN npm install
RUN npm run dev
RUN echo 'Command executed successfully'
# https://github.com/vitejs/vite/discussions/3396
# CMD ["sh", "-c", "npm install && npm run dev && echo 'Command executed successfully'"]

