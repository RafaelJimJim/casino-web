# 🎰 TFG - Proyecto de Tragaperras

Este es el proyecto de mi Trabajo de Fin de Grado (TFG).  
El objetivo es simular un conjunto de máquinas tragaperras con autenticación de usuarios.

---

## 📂 Estructura del proyecto
- `php/` → Contiene el código PHP principal (index, login, lógica de las tragaperras).
- `js/` → Scripts de JavaScript.
- `style/` → Hojas de estilo CSS.
- `imagenes/` → Imágenes utilizadas en el proyecto.
- `audio/` → Archivos de sonido.
- `database/` → Base de datos + diagramas.
- `docs/` → Documentación y otros recursos.

---

## Estructura de la base de datos
La base de datos se encuentra en la carpeta `database/` y contiene los siguientes archivos:

- `casino_vacia.sql` → Script SQL con la **estructura de la base de datos**.  
  - Tabla `maquina`: contiene la configuración de la máquina (no se borra).  
  - Tabla `usuarios`: vacía, preparada para insertar nuevos usuarios.  
  - Tabla `saldos`: vacía, preparada para registrar los saldos de los usuarios.  

- `Diagrama_BBDD_Casino.dia` → Diagrama visual de la base de datos.  
- `base de datos.png` → Imagen del diagrama de la BBDD.  

### Nota importante
- Para ejecutar el proyecto localmente:
- Importar `casino_vacia.sql` en tu servidor MySQL.  
- El archivo `php/config.php` contiene la plantilla de conexión.
- Cambia los valores `USUARIO_LOCAL` y `CONTRASEÑA_LOCAL` por tus credenciales de MySQL.
---

## ⚙️ Requisitos
- XAMPP (Apache + PHP + MySQL)
- Navegador moderno (Chrome, Firefox, Edge…)

---

## ▶️ Cómo ejecutarlo
1. Copiar el proyecto dentro de la carpeta `htdocs/` de XAMPP.
2. Iniciar Apache (y MySQL si se usa base de datos).
3. Abrir en el navegador:
