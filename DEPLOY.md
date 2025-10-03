# 🚀 Quick Deployment Guide

## For Production Deployment

### 1. Build Distribution Package

```bash
cd ~/projects/UfoBufo-secondDecade
npm run deploy
```

This will:
- Clean old builds
- Compile JavaScript with webpack
- Copy all necessary files to `dist/UfoBufo-secondDecade/`
- Show success message

### 2. Upload to WordPress

**Option A: Direct Copy (Local/Staging)**
```bash
cp -r dist/UfoBufo-secondDecade /path/to/wordpress/wp-content/themes/
```

**Option B: Create Archive (Production Server)**
```bash
npm run dist:package
# Uploads: dist/UfoBufo-secondDecade-YYYYMMDD.tar.gz
```

Then on server:
```bash
cd /wp-content/themes/
tar -xzf UfoBufo-secondDecade-YYYYMMDD.tar.gz
```

### 3. Activate in WordPress

1. Login to WordPress Admin
2. Go to Appearance → Themes
3. Activate "UFO BUFO"

## 📋 Pre-Deployment Checklist

- [ ] Test locally with `npm run build`
- [ ] Verify JavaScript bundles load correctly
- [ ] Check CSS compilation (front.min.css)
- [ ] Test on mobile devices
- [ ] Check all template files work
- [ ] Verify images load properly
- [ ] Test gallery functionality
- [ ] Check homepage animations
- [ ] Test search functionality
- [ ] Verify multilingual (CS/EN) switching

## 🔄 Quick Updates

### For JavaScript changes:
```bash
npm run build        # Rebuild in current directory
# OR
npm run dist        # Rebuild distribution
```

### For PHP template changes:
```bash
npm run dist        # Rebuild full distribution
```

### For CSS/SASS changes:
```bash
sass css/sass/front.sass css/front.min.css --style=compressed
npm run dist        # Rebuild distribution
```

## 📦 What Gets Deployed

The `dist/UfoBufo-secondDecade/` folder contains ONLY:

✅ **Production Files:**
- PHP templates
- Compiled JavaScript (js/)
- Compiled CSS (css/)
- Fonts
- Images
- Theme metadata

❌ **NOT Included:**
- Source JavaScript (assets/js/)
- SASS files (css/sass/)
- node_modules/
- Development configs
- Build tools

## 🐛 Troubleshooting Deployment

### JavaScript not loading after deployment

1. Clear WordPress cache
2. Hard refresh browser (Cmd+Shift+R)
3. Check file permissions on server
4. Verify files in wp-content/themes/UfoBufo-secondDecade/js/

### CSS not updating

1. Rebuild CSS: `sass css/sass/front.sass css/front.min.css --style=compressed`
2. Run `npm run dist`
3. Clear WordPress cache
4. Hard refresh browser

### Images missing

Check img/ directory was copied:
```bash
ls -la dist/UfoBufo-secondDecade/img/
```

## 🔐 Production Server Deployment

### Via SSH/SCP

```bash
# Package theme
npm run dist:package

# Upload to server
scp dist/UfoBufo-secondDecade-*.tar.gz user@server:/tmp/

# SSH to server and extract
ssh user@server
cd /var/www/wordpress/wp-content/themes/
tar -xzf /tmp/UfoBufo-secondDecade-*.tar.gz
chown -R www-data:www-data UfoBufo-secondDecade
```

### Via FTP

1. Build: `npm run dist`
2. ZIP the folder: `cd dist && zip -r theme.zip UfoBufo-secondDecade`
3. Upload via FTP to `/wp-content/themes/`
4. Extract on server

## 📊 File Sizes (Approximate)

After distribution build:

- **Total theme:** ~15-20MB (mostly images)
- **JavaScript:** ~320KB (5 bundles)
- **CSS:** ~150KB (compiled)
- **PHP files:** ~200KB
- **Fonts:** ~500KB
- **Images:** ~12-15MB

## ⚡ Performance Tips

1. **Enable caching** on WordPress
2. **Use CDN** for images
3. **Enable gzip** compression on server
4. **Minify HTML** output (plugin)
5. **Lazy load** images (built-in since WP 5.5)

## 🆘 Emergency Rollback

If deployment causes issues:

1. Keep previous theme folder as backup
2. Switch to backup theme in WordPress admin
3. Investigate issues
4. Redeploy when fixed

```bash
# Before deployment, backup current theme:
ssh user@server
cd /wp-content/themes
cp -r UfoBufo-secondDecade UfoBufo-secondDecade.backup.$(date +%Y%m%d)
```

---

**Last Updated:** October 2025
