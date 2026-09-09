# Superpowers Engineering Methodology

This workspace is powered by the **Superpowers** software development methodology ([obra/superpowers](https://github.com/obra/superpowers)).

## Core Principles & Iron Laws

### 1. Test-Driven Development (TDD)
- **Iron Law:** `NO PRODUCTION CODE WITHOUT A FAILING TEST FIRST`
- **Cycle:** RED (write failing test) → verify RED (watch it fail) → GREEN (write minimal code) → verify GREEN (watch it pass) → REFACTOR (clean up while green).
- If code is written before tests, delete it and start over with TDD. No exceptions.

### 2. Systematic Debugging
- **Iron Law:** `NO FIXES WITHOUT ROOT CAUSE INVESTIGATION FIRST`
- **4 Phases:**
  1. **Root Cause Investigation:** Read errors completely, reproduce reliably, trace data flow backward to origin.
  2. **Pattern Analysis:** Compare with working examples, identify differences.
  3. **Hypothesis Testing:** Form a single specific hypothesis and test minimally.
  4. **Implementation:** Create failing reproduction test, apply single fix, verify thoroughly.
- If 3+ fixes fail, stop and question the underlying architecture.

### 3. Verification Before Completion
- **Iron Law:** `NO COMPLETION CLAIMS WITHOUT FRESH VERIFICATION EVIDENCE`
- Never state "tests pass", "bug fixed", or "done" without executing the command in the same turn and reading the full output.

### 4. Brainstorming & Specification
- Hard Gate: Do NOT start coding before clarifying requirements, proposing approaches, presenting design in sections, and receiving explicit approval.
- Classify task into:
  - **Spike:** Feasibility probe; output is an answer, not permanent code.
  - **Bounded:** Small change to existing code; short design in chat + approval gate.
  - **Architectural:** New subsystems or refactoring; detailed spec doc (`docs/superpowers/specs/`) + self-review + approval gate.

### 5. Writing Plans & Execution
- Implementation plans are saved to `docs/superpowers/plans/`.
- Tasks must be bite-sized (2-5 minutes per step), specifying exact file paths, exact code blocks, and verification commands.
- Support **Subagent-Driven Development** (fresh subagents per task + spec & quality review gates) or **Executing Plans** with checkpoints.

### 6. Git Worktree & Branch Isolation
- Use isolated worktrees for feature development to protect the base branch.
- On completion, verify the full test suite, then present the 3 standard options: (1) Merge locally, (2) Push & create PR, (3) Keep branch.

### 7. Code Review Standards
- Technical verification over emotional performance.
- Avoid performative agreement ("You're absolutely right!"). Restate requirements, evaluate against codebase reality, and push back with technical reasons when appropriate.
