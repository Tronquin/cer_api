CER API
------------------------------------------------
Servidor Backend cer_api, este proyecto debe estar en un servidor centralizado para servir a todas las instancias de la maquina, ya que desde este se manejan configuraciones, auditorias, y el resto de puntos en común para todas las maquinas.


### Requerimientos:
1. Apache 2
2. php 7.0
3. composer
4. Base de datos mysql
5. git

------------------------------------------------

### Habilitar modulos apache


    sudo a2enmod rewrite

### Instalar dependencias PHP

    sudo apt-get install php7.0 php7.0-mycrypt php7.0-curl php7.0-xml php7.0-zip

**En caso de tener activa una version de php diferente a la 7.0:**

    // Cambia 5 por tu version activa
    sudo a2dismod php5
    sudo a2enmod php7.0
    sudo service apache2 restart


### Pasos para instalación

    git clone http://git.castroexclusiveresidences.com/beeam/cer_api.git
    
    cd cer_api

    composer install

    // Los permisos basta con que sean de escritura para apache
    sudo chmod -R 775 storage bootstrap/cache


**crear base de datos mysql y
configurar parámetros de conexión en el enviroment (.env)**

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=root
    DB_PASSWORD=123456789

    ERP_API_BASE= http://erpcastro.test/public_html/api/
    ERP_API_KEY=XXXXXXXXXXXXXXXXXXXXX

importante configurar datos de conexión

**ejecutar las migraciones**

    php artisan migrate --seed

**crear virtualhost a la carpeta public**