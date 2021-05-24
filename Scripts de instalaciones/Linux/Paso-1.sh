#!/bin/bash
git clone https://github.com/MohaMBS/GoHeart.git

cd GoHeart

composer install

notify-send 'GoHeart' 'Se ha cloando el proyecto y instalado los modulos del proyecto, porfavor ahora configure el ficero .env y luego ejecute el segundo script.'
espeak "GoHeart has been cloned"