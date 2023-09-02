
###############################################################################
# - Jason Brillante "Damdoshi"                                                #
# - Pentacle Technologie 2008-2023					      #
# - Hanged Bunny Studio 2014-2021					      #
# - EFRITS 2022-2023							      #
###############################################################################

LANG	=	fr
OUTPUT	=	dabsic-$(LANG).pdf
CATOUT	=	output.php
PHPOUT	=	output.md

SRC	=	$(shell find src/$(LANG)/ -name "*.php" | sort)

OPTIONS	=	--columns 1000 # -V papersize:a4

all:		clean $(SRC)
		(cd src/ && php ../$(CATOUT) > ../$(PHPOUT))
		pandoc $(OPTIONS) $(PHPOUT) -o $(OUTPUT)
clean:
		rm -f $(CATOUT) $(PHPOUT)
fclean:		clean
		rm -f $(OUTPUT)
re:		fclean all

###############################################################################

$(SRC):
		cat $@ >> $(CATOUT)
		echo >> $(CATOUT)

.PHONY: all clean fclean re $(SRC)
