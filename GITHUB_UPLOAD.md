# 📤 GitHub Upload Instructions

## Step 1: Create GitHub Repository

1. Go to [GitHub](https://github.com)
2. Click on **"+"** (top right) → **"New repository"**
3. Fill in details:
   - **Repository name**: `lithos-marble-luxury` (or your choice)
   - **Description**: `Dynamic Laravel 10 application for luxury marble business with admin panel and WhatsApp integration`
   - **Visibility**: Choose Public or Private
   - **DO NOT** initialize with README (we already have one)
4. Click **"Create repository"**

## Step 2: Connect Local Repository to GitHub

After creating the repository, GitHub will show you commands. Use these:

```bash
cd /Users/sahilarman/Downloads/marble_luxury/marble_luxury_laravel

# Add GitHub remote (replace YOUR_USERNAME and REPO_NAME)
git remote add origin https://github.com/YOUR_USERNAME/REPO_NAME.git

# Or if using SSH:
git remote add origin git@github.com:YOUR_USERNAME/REPO_NAME.git

# Verify remote
git remote -v
```

## Step 3: Push to GitHub

```bash
# Push to main branch
git branch -M main
git push -u origin main
```

## Alternative: Using GitHub CLI (if installed)

```bash
# Login to GitHub
gh auth login

# Create repo and push
gh repo create lithos-marble-luxury --public --source=. --remote=origin --push
```

## Step 4: Verify Upload

1. Go to your GitHub repository URL
2. You should see all files uploaded
3. README.md will be displayed on the repository homepage

---

## 🔐 Important: Secure Your Repository

### Before Pushing, Make Sure:

✅ `.env` file is in `.gitignore` (already done)  
✅ No sensitive data in committed files  
✅ Database credentials are not exposed  

### After Pushing:

1. **Add Repository Secrets** (for CI/CD):
   - Go to Settings → Secrets and variables → Actions
   - Add secrets like `DB_PASSWORD`, `APP_KEY`, etc.

2. **Update README** with your repo URL:
   - Edit line 15 in README.md
   - Replace `<your-repo-url>` with actual GitHub URL

---

## 📋 Quick Command Summary

```bash
# Navigate to project
cd /Users/sahilarman/Downloads/marble_luxury/marble_luxury_laravel

# Add remote (replace with your details)
git remote add origin https://github.com/YOUR_USERNAME/lithos-marble-luxury.git

# Push to GitHub
git branch -M main
git push -u origin main
```

---

## 🎉 After Upload

Your repository will be live at:
```
https://github.com/YOUR_USERNAME/lithos-marble-luxury
```

Share this URL with collaborators or add it to your portfolio!

---

## 🔄 Future Updates

When you make changes:

```bash
# Stage changes
git add .

# Commit with message
git commit -m "Your commit message"

# Push to GitHub
git push
```

---

## 🆘 Troubleshooting

**If you get authentication errors:**
```bash
# Use personal access token instead of password
# Generate token at: https://github.com/settings/tokens
```

**If remote already exists:**
```bash
git remote remove origin
git remote add origin YOUR_NEW_URL
```

**If you want to change branch name:**
```bash
git branch -M main
```

---

**Need help?** Check [GitHub Docs](https://docs.github.com/en/get-started/importing-your-projects-to-github/importing-source-code-to-github/adding-locally-hosted-code-to-github)
