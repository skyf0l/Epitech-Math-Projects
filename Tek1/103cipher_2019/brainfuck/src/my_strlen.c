/*
** BRAINFUCK PROJECT, 2019
** MY_STRLEN
** File description:
** My_strlen
*/

int my_strlen(char const *str)
{
    int len;

    for (len = 0; str[len]; len++);
    return (len);
}