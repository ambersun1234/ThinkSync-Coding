GIT_HOOKS := .git/hooks/applied
hook: ${GIT_HOOKS}

$(GIT_HOOKS):
	@bash ./scripts/install-git-hooks
	@echo

.PHONY: clean

clean:
	rm -f .git/hooks/applied .git/hooks/commit-msg
