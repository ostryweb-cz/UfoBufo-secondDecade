#!/usr/bin/env node

const fs = require('fs');
const path = require('path');

const styleFile = path.join(__dirname, 'style.css');

// Get current date in dmY format (28012026)
const now = new Date();
const day = String(now.getDate()).padStart(2, '0');
const month = String(now.getMonth() + 1).padStart(2, '0');
const year = now.getFullYear();
const dateBase = `${day}${month}${year}`;

// Read the current style.css
let content = fs.readFileSync(styleFile, 'utf8');

// Extract existing version
const versionMatch = content.match(/Version:\s*([\d.]+)/);
const currentVersion = versionMatch ? versionMatch[1] : '';

// Determine new version
let newVersion;
if (currentVersion.startsWith(dateBase)) {
  // Same day, increment suffix
  const suffix = currentVersion.split('.')[1] || '0';
  const nextSuffix = parseInt(suffix) + 1;
  newVersion = `${dateBase}.${nextSuffix}`;
} else {
  // New day, reset suffix
  newVersion = `${dateBase}.1`;
}

// Update the version in style.css
content = content.replace(/Version:\s*[\d.]+/, `Version: ${newVersion}`);

fs.writeFileSync(styleFile, content, 'utf8');

console.log(`✅ Version updated: ${newVersion}`);
