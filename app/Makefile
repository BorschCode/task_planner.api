# ===============================================
# Makefile for PHP Static Analysis and Linting
# ===============================================

# Path to vendor binaries
VENDOR_BIN := vendor/bin

# Targets that do not produce files
.PHONY: quality phpstan phpcs lint fix

# -----------------------------------------------
# MAIN TARGETS
# -----------------------------------------------

# Run all quality checks: PHPStan + PHP CodeSniffer
quality: phpstan phpcs
	@echo "✨ Quality checks completed successfully."

# Alias 'lint' to run PHPStan and PHP CodeSniffer
lint: phpstan phpcs
	@echo "🔍 Linting (PHPStan + PHPCS) completed successfully."

# -----------------------------------------------
# INDIVIDUAL CHECKS
# -----------------------------------------------

# Run PHPStan for static analysis
phpstan:
	@echo "--- Running PHPStan Static Analysis ---"
	@$(VENDOR_BIN)/phpstan analyse --memory-limit=256M

# Run PHP CodeSniffer to detect style violations
phpcs:
	@echo "--- Running PHP CodeSniffer (Style Check) ---"
	@$(VENDOR_BIN)/phpcs

# -----------------------------------------------
# UTILITIES
# -----------------------------------------------

# Automatically fix code style issues using PHPCBF
fix:
	@echo "--- Running PHP Code Beautifier and Fixer (Auto-fix) ---"
	@$(VENDOR_BIN)/phpcbf
