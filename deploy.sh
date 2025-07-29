#!/bin/bash

echo "🚀 Starting Deployment Process..."

# Check if Vercel CLI is installed
if ! command -v vercel &> /dev/null; then
    echo "📦 Installing Vercel CLI..."
    npm install -g vercel
fi

# Check if user is logged in
if ! vercel whoami &> /dev/null; then
    echo "🔐 Please login to Vercel..."
    vercel login
fi

echo "🏗️ Building application..."
npm run build

echo "🚀 Deploying to Vercel..."
vercel --prod

echo "✅ Deployment completed!"
echo "🌐 Your app is live at: https://datakaryawan.vercel.app"
echo ""
echo "📋 Next steps:"
echo "1. Setup database at PlanetScale"
echo "2. Configure environment variables"
echo "3. Test the application"
echo "4. Submit to recruitment team"