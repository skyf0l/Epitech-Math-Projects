/*
** EPITECH PROJECT, 2019
** MY_STRCHR
** File description:
** My_strchr func
*/

#include <stddef.h>

char *my_strchr(char const *str, char c)
{
    if (!str)
        return (NULL);
    for (int k = 0; str[k]; k++)
        if (str[k] == c)
            return ((char *)&str[k]);
    return (NULL);
}