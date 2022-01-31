SRCS = $(shell find src -name "*.php")
IMGS = $(SRCS:.php=.jpg)

## powerglot.py from https://github.com/mindcrypt/powerglot/

all: $(IMGS)

%.jpg: %.php
	@python3 powerglot.py -o $< 204ducks.jpg ../$(notdir $@)
	@echo -n "*/" >> ../$(notdir $@)

clean:
	@rm -f ../*.jpg
	@rm -f ../*.txt