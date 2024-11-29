# Paleta de Colores

Este proyecto usa una paleta de colores específica para mantener una interfaz coherente. 
Su uso, realizado por Javier Arias Carroza:

## Colores

### Colores Principales

- **Azul (#1D4E89)**:  
  - Usado en el encabezado, pie de página y enlaces importantes.
  - Ejemplo de uso:
    ```css
    background-color: #1D4E89;
    color: #F8F8F0;
    ```

- **Amarillo (#E3B505)**:  
  - Usado en botones de acción (como "Aceptar").
  - Ejemplo de uso:
    ```css
    background-color: #E3B505;
    color: #F8F8F0;
    ```

- **Verde (#3B7359)**:  
  - Usado en botones de acción positiva (como "Modificar").
  - Ejemplo de uso:
    ```css
    background-color: #3B7359;
    color: #F8F8F0;
    ```

### Colores Secundarios

- **Rojo (#D22B2B)**:  
  - Usado en botones de acción negativa (como "Eliminar").
  - Ejemplo de uso:
    ```css
    background-color: #D22B2B;
    color: #F8F8F0;
    ```

- **Gris Oscuro (#2F2F2F)**:  
  - Usado en el fondo de la página y texto de elementos secundarios.
  - Ejemplo de uso:
    ```css
    background-color: #2F2F2F;
    color: #F8F8F0;
    ```

- **Blanco (#F8F8F0)**:  
  - Usado para texto y detalles, proporcionando contraste con fondos oscuros.
  - Ejemplo de uso:
    ```css
    color: #F8F8F0;
    ```

## Estructura CSS

- **Fuente (`font-family`)**:
    ```css
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    ```

- **Encabezado (`header`)**:
    ```css
    background-color: #1D4E89;
    color: #F8F8F0;
    ```

- **Botones**:
    ```css
    background-color: #E3B505; /* Amarillo para 'Aceptar' */
    background-color: #3B7359; /* Verde para 'Modificar' */
    background-color: #D22B2B; /* Rojo para 'Eliminar' */
    ```

- **Fila de Personaje (`.fila-personaje`)**:
    ```css
    background-color: #FFFFFF; /* Blanco */
    border-color: #ddd; /* Gris claro */
    ```

- **Footer (`footer`)**:
    ```html
    <footer>
        <p>© 2024 Decisiones de Vida. Todos los derechos reservados.</p>
    </footer>
    ```
    ```css
    footer {
    text-align: center;
    padding: 3% 5%;
    background-color: var(--color-azul);
    border-top: 1px solid #ddd;
    color: var(--color-blanco);
    }
    ```

## Conclusión

Cada color se utiliza para crear una jerarquía visual que facilita la interacción del usuario con la interfaz. Los colores principales se enfocan en acciones clave y elementos destacados, mientras que los colores secundarios proporcionan un fondo neutro y claro.
