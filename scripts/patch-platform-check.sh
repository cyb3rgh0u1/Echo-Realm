#!/bin/bash
PLATFORM_FILE="vendor/composer/platform_check.php"
if [ -f "$PLATFORM_FILE" ]; then
    cat > "$PLATFORM_FILE" << 'EOF'
<?php
// Platform check disabled for PHP 8.5+ compatibility
EOF
    echo "✓ Platform check patched successfully"
else
    echo "⚠ $PLATFORM_FILE not found — run: composer install --no-scripts first"
fi
