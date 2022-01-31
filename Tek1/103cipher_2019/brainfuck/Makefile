##
## EPITECH PROJECT, 2019
## MAKEFILE
## File description:
## Brainfuck makefile
##
# ========================= VAR ========================= #

NAME = bf

MAIN = src/main.c

SRC = my_strlen.c my_strchr.c

SRC_TEST =

LIBS =

OTHER_FLAGS =

# ======================================================= #

ECHO = echo -e

NO_COLOR = \x1b[0m
OK_COLOR = \x1b[32;01m
ERROR_COLOR = \x1b[31;01m
WARN_COLOR = \x1b[33;01m

OK_STRING = $(OK_COLOR)[✔]$(NO_COLOR)
ERROR_STRING = $(ERROR_COLOR)[X]$(NO_COLOR)
WARN_STRING = $(WARN_COLOR)[!]$(NO_COLOR)

CC = gcc -fdiagnostics-color=always

$(eval SRC = $(addprefix src/, $(SRC)))
$(eval SRC_TEST = $(addprefix tests/, $(SRC_TEST)))
LIBNAME =

DEBUG_NAME = debug
TEST_NAME = unit_tests
TEST_BUILD = *.gcno *.gcda

CFLAGS = -Wall -Wextra -I./include

BUILD_LOGS = build.log
TEMP_LOGS = temp.log
TEMP_ERRORS = temp.errors
CLEAN_LOGS = clean.log
LOGS = $(BUILD_LOGS) $(TEMP_LOGS) $(TEMP_ERRORS) $(CLEAN_LOGS)

all: $(NAME)

$(NAME):
	@for i in $(LIBS); do \
		(cd lib/$$i/ && make -s -i); \
	done
	@$(CC) $(CFLAGS) $(OTHER_FLAGS) -o $(NAME) $(SRC) $(MAIN) -L. $(LIBNAME) 2> $(TEMP_LOGS) || touch $(TEMP_ERRORS)
	@if test -e $(TEMP_ERRORS); \
	then \
		$(ECHO) "$(NAME) -> make $(ERROR_STRING)"; \
	    cat $(TEMP_LOGS); \
	elif test -s $(TEMP_LOGS); \
	then \
		$(ECHO) "$(NAME) -> make $(WARN_STRING)"; \
	    cat $(TEMP_LOGS); \
	else \
		$(ECHO) "$(NAME) -> make $(OK_STRING)"; \
	fi

clean:
	@for i in $(LIBS); do \
		(cd lib/$$i/ && make clean) >> $(CLEAN_LOGS); \
	done
	@$(ECHO) "$(NAME) -> clean $(OK_STRING)"

fclean:
	@$(MAKE) clean >> $(CLEAN_LOGS)
	@for i in $(LIBS); do \
		(cd lib/$$i/ && make fclean) >> $(CLEAN_LOGS); \
	done
	@rm -f $(NAME) $(TEST_NAME) $(TEST_BUILD) $(DEBUG_NAME)
	@rm -f $(LOGS)
	@$(ECHO) "$(NAME) -> fclean $(OK_STRING)"

re: fclean all

tests_run: fclean all
	@$(CC) $(CFLAGS) $(OTHER_FLAGS) -o $(TEST_NAME) $(SRC) $(SRC_TEST) -L. $(LIBNAME) --coverage -lcriterion
	@$(ECHO) "$(NAME) -> make tests_run $(OK_STRING)"
	@./$(TEST_NAME)

debug: fclean
	@for i in $(LIBS); do \
		cd lib/$$i/ && make debug; \
	done
	$(CC) -g3 $(CFLAGS) $(OTHER_FLAGS) -o $(DEBUG_NAME) $(SRC) $(MAIN) -L. $(LIBNAME)