const fs = require("fs");
const { execSync } = require("child_process");

const fileName = process.argv[2];

if (!fileName) {
  console.error("Debes indicar un nombre de archivo. Ej: npm run php archivo");
  process.exit(1);
}

const basePath = process.env.INIT_CWD; // <-- la carpeta real donde ejecutaste el comando
const filePath = `${basePath}/${fileName}.php`;

const content = "<?php\n\n?>\n";

fs.writeFileSync(filePath, content);

console.log(`Archivo creado: ${filePath}`);

try {
  execSync(`code "${filePath}"`);
} catch {
  console.warn("No se pudo abrir con VS Code");
}
