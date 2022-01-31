NAME = radiator
TARGET = 306$(NAME)
TARGET_DEBUG = 306$(NAME)_debug

all:
	@cargo build --release
	@cp target/release/$(NAME) $(TARGET)

debug:
	@cargo build
	@cp target/debug/$(NAME) $(TARGET_DEBUG)

run: $(TARGET)
	@cargo run --release

clean:
	@cargo clean

fclean: clean
	@rm -f $(TARGET)
	@rm -f $(TARGET_DEBUG)

re:
	@$(MAKE) -s fclean
	@$(MAKE) -s all

check:
	@cargo check

tests_run: all
	@./tests.sh