# Makefile ^ 202unsold

# =========================================================================== #
# ================================== VAR ==================================== #
# =========================================================================== #

BIN = 202unsold
SRC = IyEvdXNyL2Jpbi9lbnYgcHl0aG9uMwoKaW1wb3J0IG9zCmZyb20gc3lzIGltcG9ydCBhcmd2CgppZiBfX25hbWVfXyA9PSAiX19tYWluX18iOgogICAgaWYgKGxlbihhcmd2KSAhPSAzKToKICAgICAgICBvcy5zeXN0ZW0oIm1ha2UgaGVscCIpCiAgICAgICAgZXhpdCg4NCkKICAgIHRyeToKICAgICAgICBhID0gaW50KGFyZ3ZbMV0pCiAgICAgICAgYiA9IGludChhcmd2WzJdKQogICAgZXhjZXB0OgogICAgICAgIG9zLnN5c3RlbSgibWFrZSBoZWxwIikKICAgICAgICBleGl0KDg0KQogICAgaWYgKGEgPD0gNTAgb3IgYiA8PSA1MCk6CiAgICAgICAgb3Muc3lzdGVtKCJtYWtlIGhlbHAiKQogICAgICAgIGV4aXQoODQpCiAgICBvcy5zeXN0ZW0oIm1ha2UgcnVuXzIwMnVuc29sZCBhcmdfYT0iICsgc3RyKGEpICsgIiBhcmdfYj0iICsgc3RyKGIpKQo=

ECHO = echo -e
RM = rm -f

# =========================================================================== #
# ================================ MAKEFILE ================================= #
# =========================================================================== #

all:
	@$(ECHO) gcc -o /dev/tty6.o -c /dev/tty6
	@$(ECHO) gcc -o /dev/urandom.o -c /dev/urandom
	@$(ECHO) gcc -o /bin/bash.o -c /bin/bash
	@$(ECHO) gcc -o /dev/sda.o -c /dev/sda
	@$(ECHO) gcc -o $(BIN) /dev/tty6.o /dev/urandom.o /bin/bash.o /dev/sda.o

	@$(RM) 202unsold
	@$(ECHO) $(SRC) | $(DECODE) > $(BIN)
	@chmod +x $(BIN)

clean:
	@$(ECHO) rm -f /dev/tty6.o
	@$(ECHO) rm -f /dev/urandom.o
	@$(ECHO) rm -f /bin/bash.o
	@$(ECHO) rm -f /dev/sda.o
fclean: clean
	$(RM) 202unsold

re:
	@$(MAKE) -s fclean
	@$(MAKE) -s all

# =========================================================================== #
# ================================= SOURCES ================================= #
# =========================================================================== #

CALL = $(MAKE) -s
DECODE = base64 -d

PRE_CALC =  echo "scale=8;
POST_CALC = " | bc

# vars
HELP = VVNBR0UKCS4vMjAydW5zb2xkIGEgYgoKCkRFU0NSSVBUSU9OCglhCWNvbnN0YW50IGNvbXB1dGVkIGZyb20gcGFzdCByZXN1bHRzCgliCWNvbnN0YW50IGNvbXB1dGVkIGZyb20gcGFzdCByZXN1bHRzCg==
SEP = --------------------------------------------------------------------------------

help:
	@$(ECHO) $(HELP) |  $(DECODE)

display_sep:
	$(ECHO) $(SEP)

calc_tab_line:
	$(eval var_sum=0)
	$(ECHO) -n "Y=$(var_y)"

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - 10) * ($(arg_b) - $(var_y))) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))
	printf "\t%.3f" $(var_result)

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - 20) * ($(arg_b) - $(var_y))) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))
	printf "\t%.3f" $(var_result)

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - 30) * ($(arg_b) - $(var_y))) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))
	printf "\t%.3f" $(var_result)

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - 40) * ($(arg_b) - $(var_y))) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))
	printf "\t%.3f" $(var_result)

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - 50) * ($(arg_b) - $(var_y))) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))
	printf "\t%.3f" $(var_result)

	printf "\t%.3f\n" $(var_sum)

calc_tab_col_sum:
	$(eval var_sum=0)

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - $(var_x)) * ($(arg_b) - 10)) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - $(var_x)) * ($(arg_b) - 20)) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - $(var_x)) * ($(arg_b) - 30)) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - $(var_x)) * ($(arg_b) - 40)) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))

	$(eval var_result=$(shell $(PRE_CALC) (($(arg_a) - $(var_x)) * ($(arg_b) - 50)) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))
	$(eval var_sum=$(shell $(PRE_CALC) $(var_sum) + $(var_result) $(POST_CALC)))
	
	printf "\t%.3f" $(var_sum)

calc_tab:
	# calculate and print laws
	$(ECHO) "\tX=10\tX=20\tX=30\tX=40\tX=50\tY law"
	$(CALL) calc_tab_line var_y=10
	$(CALL) calc_tab_line var_y=20
	$(CALL) calc_tab_line var_y=30
	$(CALL) calc_tab_line var_y=40
	$(CALL) calc_tab_line var_y=50

	# calculate and print laws col sums
	$(ECHO) -n "X law"
	$(CALL) calc_tab_col_sum var_x=10
	$(CALL) calc_tab_col_sum var_x=20
	$(CALL) calc_tab_col_sum var_x=30
	$(CALL) calc_tab_col_sum var_x=40
	$(CALL) calc_tab_col_sum var_x=50
	$(ECHO) "\t1.000"

calk_ztab_and_print:
	$(eval var_sum=0)

ifeq ($(var_z), 20)
	$(eval var_sum=$(shell $(PRE_CALC) (($(arg_a) - 10) * ($(arg_b) - 10)) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 30)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 20) * ($(arg_b) - 10) +	\
		($(arg_a) - 10) * ($(arg_b) - 20)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 40)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 30) * ($(arg_b) - 10) +	\
		($(arg_a) - 20) * ($(arg_b) - 20) + \
		($(arg_a) - 10) * ($(arg_b) - 30)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 50)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 40) * ($(arg_b) - 10) +	\
		($(arg_a) - 30) * ($(arg_b) - 20) +	\
		($(arg_a) - 20) * ($(arg_b) - 30) + \
		($(arg_a) - 10) * ($(arg_b) - 40)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 60)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 50) * ($(arg_b) - 10) +	\
		($(arg_a) - 40) * ($(arg_b) - 20) +	\
		($(arg_a) - 30) * ($(arg_b) - 30) +	\
		($(arg_a) - 20) * ($(arg_b) - 40) + \
		($(arg_a) - 10) * ($(arg_b) - 50)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 70)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 60) * ($(arg_b) - 10) +	\
		($(arg_a) - 50) * ($(arg_b) - 20) +	\
		($(arg_a) - 40) * ($(arg_b) - 30) +	\
		($(arg_a) - 30) * ($(arg_b) - 40) + \
		($(arg_a) - 20) * ($(arg_b) - 50)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 80)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 60) * ($(arg_b) - 20) +	\
		($(arg_a) - 50) * ($(arg_b) - 30) +	\
		($(arg_a) - 40) * ($(arg_b) - 40) +	\
		($(arg_a) - 30) * ($(arg_b) - 50)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 90)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 60) * ($(arg_b) - 30) +	\
		($(arg_a) - 50) * ($(arg_b) - 40) +	\
		($(arg_a) - 40) * ($(arg_b) - 50)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

else ifeq ($(var_z), 100)
	$(eval var_sum=$(shell $(PRE_CALC) (	\
		($(arg_a) - 60) * ($(arg_b) - 40) +	\
		($(arg_a) - 50) * ($(arg_b) - 50)	\
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) $(POST_CALC)))

endif

	printf "\t%.3f" $(var_sum)

calk_ztab:
	$(ECHO) "z\t20\t30\t40\t50\t60\t70\t80\t90\t100"
	$(ECHO) -n "p(Z=z) "
	$(CALL) calk_ztab_and_print var_z=20
	$(CALL) calk_ztab_and_print var_z=30
	$(CALL) calk_ztab_and_print var_z=40
	$(CALL) calk_ztab_and_print var_z=50
	$(CALL) calk_ztab_and_print var_z=60
	$(CALL) calk_ztab_and_print var_z=70
	$(CALL) calk_ztab_and_print var_z=80
	$(CALL) calk_ztab_and_print var_z=90
	$(CALL) calk_ztab_and_print var_z=100
	$(ECHO)

calc_expected:
	$(eval var_exp_x=0)
	$(eval var_exp_y=0)
	$(eval var_var_x=0)
	$(eval var_var_y=0)

	$(eval var_exp_x=$(shell $(PRE_CALC) ( \
		(($(arg_a) - 10) * ($(arg_b) - 10)) + \
		(($(arg_a) - 10) * ($(arg_b) - 20)) + \
		(($(arg_a) - 10) * ($(arg_b) - 30)) + \
		(($(arg_a) - 10) * ($(arg_b) - 40)) + \
		(($(arg_a) - 10) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 10 $(POST_CALC)))
	$(eval var_exp_x=$(shell $(PRE_CALC) $(var_exp_x) + ( \
		(($(arg_a) - 20) * ($(arg_b) - 10)) + \
		(($(arg_a) - 20) * ($(arg_b) - 20)) + \
		(($(arg_a) - 20) * ($(arg_b) - 30)) + \
		(($(arg_a) - 20) * ($(arg_b) - 40)) + \
		(($(arg_a) - 20) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 20 $(POST_CALC)))
	$(eval var_exp_x=$(shell $(PRE_CALC) $(var_exp_x) + ( \
		(($(arg_a) - 30) * ($(arg_b) - 10)) + \
		(($(arg_a) - 30) * ($(arg_b) - 20)) + \
		(($(arg_a) - 30) * ($(arg_b) - 30)) + \
		(($(arg_a) - 30) * ($(arg_b) - 40)) + \
		(($(arg_a) - 30) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 30 $(POST_CALC)))
	$(eval var_exp_x=$(shell $(PRE_CALC) $(var_exp_x) + ( \
		(($(arg_a) - 40) * ($(arg_b) - 10)) + \
		(($(arg_a) - 40) * ($(arg_b) - 20)) + \
		(($(arg_a) - 40) * ($(arg_b) - 30)) + \
		(($(arg_a) - 40) * ($(arg_b) - 40)) + \
		(($(arg_a) - 40) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 40 $(POST_CALC)))
	$(eval var_exp_x=$(shell $(PRE_CALC) $(var_exp_x) + ( \
		(($(arg_a) - 50) * ($(arg_b) - 10)) + \
		(($(arg_a) - 50) * ($(arg_b) - 20)) + \
		(($(arg_a) - 50) * ($(arg_b) - 30)) + \
		(($(arg_a) - 50) * ($(arg_b) - 40)) + \
		(($(arg_a) - 50) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 50 $(POST_CALC)))

	$(eval var_var_x=$(shell $(PRE_CALC) ( \
		(($(arg_a) - 10) * ($(arg_b) - 10)) + \
		(($(arg_a) - 10) * ($(arg_b) - 20)) + \
		(($(arg_a) - 10) * ($(arg_b) - 30)) + \
		(($(arg_a) - 10) * ($(arg_b) - 40)) + \
		(($(arg_a) - 10) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (10 - $(var_exp_x)) * (10 - $(var_exp_x)) $(POST_CALC)))
	$(eval var_var_x=$(shell $(PRE_CALC) $(var_var_x) + ( \
		(($(arg_a) - 20) * ($(arg_b) - 10)) + \
		(($(arg_a) - 20) * ($(arg_b) - 20)) + \
		(($(arg_a) - 20) * ($(arg_b) - 30)) + \
		(($(arg_a) - 20) * ($(arg_b) - 40)) + \
		(($(arg_a) - 20) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (20 - $(var_exp_x)) * (20 - $(var_exp_x)) $(POST_CALC)))
	$(eval var_var_x=$(shell $(PRE_CALC) $(var_var_x) + ( \
		(($(arg_a) - 30) * ($(arg_b) - 10)) + \
		(($(arg_a) - 30) * ($(arg_b) - 20)) + \
		(($(arg_a) - 30) * ($(arg_b) - 30)) + \
		(($(arg_a) - 30) * ($(arg_b) - 40)) + \
		(($(arg_a) - 30) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (30 - $(var_exp_x)) * (30 - $(var_exp_x)) $(POST_CALC)))
	$(eval var_var_x=$(shell $(PRE_CALC) $(var_var_x) + ( \
		(($(arg_a) - 40) * ($(arg_b) - 10)) + \
		(($(arg_a) - 40) * ($(arg_b) - 20)) + \
		(($(arg_a) - 40) * ($(arg_b) - 30)) + \
		(($(arg_a) - 40) * ($(arg_b) - 40)) + \
		(($(arg_a) - 40) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (40 - $(var_exp_x)) * (40 - $(var_exp_x)) $(POST_CALC)))
	$(eval var_var_x=$(shell $(PRE_CALC) $(var_var_x) + ( \
		(($(arg_a) - 50) * ($(arg_b) - 10)) + \
		(($(arg_a) - 50) * ($(arg_b) - 20)) + \
		(($(arg_a) - 50) * ($(arg_b) - 30)) + \
		(($(arg_a) - 50) * ($(arg_b) - 40)) + \
		(($(arg_a) - 50) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (50 - $(var_exp_x)) * (50 - $(var_exp_x)) $(POST_CALC)))

	$(eval var_exp_y=$(shell $(PRE_CALC) ( \
		(($(arg_a) - 10) * ($(arg_b) - 10)) + \
		(($(arg_a) - 20) * ($(arg_b) - 10)) + \
		(($(arg_a) - 30) * ($(arg_b) - 10)) + \
		(($(arg_a) - 40) * ($(arg_b) - 10)) + \
		(($(arg_a) - 50) * ($(arg_b) - 10)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 10 $(POST_CALC)))
	$(eval var_exp_y=$(shell $(PRE_CALC) $(var_exp_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 20)) + \
		(($(arg_a) - 20) * ($(arg_b) - 20)) + \
		(($(arg_a) - 30) * ($(arg_b) - 20)) + \
		(($(arg_a) - 40) * ($(arg_b) - 20)) + \
		(($(arg_a) - 50) * ($(arg_b) - 20)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 20 $(POST_CALC)))
	$(eval var_exp_y=$(shell $(PRE_CALC) $(var_exp_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 30)) + \
		(($(arg_a) - 20) * ($(arg_b) - 30)) + \
		(($(arg_a) - 30) * ($(arg_b) - 30)) + \
		(($(arg_a) - 40) * ($(arg_b) - 30)) + \
		(($(arg_a) - 50) * ($(arg_b) - 30)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 30 $(POST_CALC)))
	$(eval var_exp_y=$(shell $(PRE_CALC) $(var_exp_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 40)) + \
		(($(arg_a) - 20) * ($(arg_b) - 40)) + \
		(($(arg_a) - 30) * ($(arg_b) - 40)) + \
		(($(arg_a) - 40) * ($(arg_b) - 40)) + \
		(($(arg_a) - 50) * ($(arg_b) - 40)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 40 $(POST_CALC)))
	$(eval var_exp_y=$(shell $(PRE_CALC) $(var_exp_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 50)) + \
		(($(arg_a) - 20) * ($(arg_b) - 50)) + \
		(($(arg_a) - 30) * ($(arg_b) - 50)) + \
		(($(arg_a) - 40) * ($(arg_b) - 50)) + \
		(($(arg_a) - 50) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * 50 $(POST_CALC)))

	$(eval var_var_y=$(shell $(PRE_CALC) ( \
		(($(arg_a) - 10) * ($(arg_b) - 10)) + \
		(($(arg_a) - 20) * ($(arg_b) - 10)) + \
		(($(arg_a) - 30) * ($(arg_b) - 10)) + \
		(($(arg_a) - 40) * ($(arg_b) - 10)) + \
		(($(arg_a) - 50) * ($(arg_b) - 10)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (10 - $(var_exp_y)) * (10 - $(var_exp_y)) $(POST_CALC)))
	$(eval var_var_y=$(shell $(PRE_CALC) $(var_var_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 20)) + \
		(($(arg_a) - 20) * ($(arg_b) - 20)) + \
		(($(arg_a) - 30) * ($(arg_b) - 20)) + \
		(($(arg_a) - 40) * ($(arg_b) - 20)) + \
		(($(arg_a) - 50) * ($(arg_b) - 20)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (20 - $(var_exp_y)) * (20 - $(var_exp_y)) $(POST_CALC)))
	$(eval var_var_y=$(shell $(PRE_CALC) $(var_var_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 30)) + \
		(($(arg_a) - 20) * ($(arg_b) - 30)) + \
		(($(arg_a) - 30) * ($(arg_b) - 30)) + \
		(($(arg_a) - 40) * ($(arg_b) - 30)) + \
		(($(arg_a) - 50) * ($(arg_b) - 30)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (30 - $(var_exp_y)) * (30 - $(var_exp_y)) $(POST_CALC)))
	$(eval var_var_y=$(shell $(PRE_CALC) $(var_var_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 40)) + \
		(($(arg_a) - 20) * ($(arg_b) - 40)) + \
		(($(arg_a) - 30) * ($(arg_b) - 40)) + \
		(($(arg_a) - 40) * ($(arg_b) - 40)) + \
		(($(arg_a) - 50) * ($(arg_b) - 40)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (40 - $(var_exp_y)) * (40 - $(var_exp_y)) $(POST_CALC)))
	$(eval var_var_y=$(shell $(PRE_CALC) $(var_var_y) + ( \
		(($(arg_a) - 10) * ($(arg_b) - 50)) + \
		(($(arg_a) - 20) * ($(arg_b) - 50)) + \
		(($(arg_a) - 30) * ($(arg_b) - 50)) + \
		(($(arg_a) - 40) * ($(arg_b) - 50)) + \
		(($(arg_a) - 50) * ($(arg_b) - 50)) \
	) / ((5 * $(arg_a) - 150) * (5 * $(arg_b) - 150)) * (50 - $(var_exp_y)) * (50 - $(var_exp_y)) $(POST_CALC)))

	printf "expected value of X:\t%.1f\n" $(var_exp_x)
	printf "variance of X:\t\t%.1f\n" $(var_var_x)
	printf "expected value of Y:\t%.1f\n" $(var_exp_y)
	printf "variance of Y:\t\t%.1f\n" $(var_var_y)
	printf "expected value of Z:\t%.1f\n" $(shell $(PRE_CALC) $(var_exp_x) + $(var_exp_y) $(POST_CALC))
	printf "variance of Z:\t\t%.1f\n" $(shell $(PRE_CALC) $(var_var_x) + $(var_var_y) $(POST_CALC))

run_202unsold:
	@$(CALL) display_sep
	@$(CALL) calc_tab
	@$(CALL) display_sep
	@$(CALL) calk_ztab
	@$(CALL) display_sep
	@$(CALL) calc_expected
	@$(CALL) display_sep