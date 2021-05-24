Add-Type -AssemblyName System.Windows.Forms

git clone https://github.com/MohaMBS/GoHeart.git

cd GoHeart

composer install


[System.Windows.Forms.MessageBox]::Show("Se ha cloando el proyecto y instalado los modulos del proyecto, porfavor ahora configure el ficero .env y luego ejecute el segundo script.","GoHeart instalador")