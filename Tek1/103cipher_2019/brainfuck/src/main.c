/*
** BRAINFUCK PROJECT, 2019
** MAIN
** File description:
** Brainfuck interpreter
*/

#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>

#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include "brainfuck.h"

void my_put_nbr(int nb);
void my_putstr(char const *str);

unsigned short *opti_cmd(char const **cmd)
{
    int len;
    unsigned short *repeat;
    char *new_cmd;
    int new_i_cmd = -1;
    char last_cmd = 0;

    for (len = 0; cmd[0][len]; len++);
    repeat = malloc(sizeof(unsigned short) * (len + 1));
    new_cmd = malloc(sizeof(char) * (len + 1));
    for (int i_cmd = 0; cmd[0][i_cmd]; i_cmd++) {
        if (last_cmd == cmd[0][i_cmd] && (cmd[0][i_cmd] == '+' || cmd[0][i_cmd] == '-' || cmd[0][i_cmd] == '<' || cmd[0][i_cmd] == '>'))
            repeat[new_i_cmd]++;
        else {
            new_i_cmd++;
            repeat[new_i_cmd] = 1;
            new_cmd[new_i_cmd] = cmd[0][i_cmd];
        }
        last_cmd = cmd[0][i_cmd];
    }
    cmd[0] = new_cmd;
    return (repeat);
}

void opti_interpreter(char *cmd, unsigned short *repeat, char const *input)
{
    char *mem = malloc(sizeof(char) * (30000));
    int id_mem = 0;
    int layer;

    for (int id_cmd = 0; cmd[id_cmd]; id_cmd++) {
        if (cmd[id_cmd] == '>')
            id_mem += repeat[id_cmd];
        else if (cmd[id_cmd] == '<')
            id_mem -= repeat[id_cmd];
        else if (cmd[id_cmd] == '+')
            mem[id_mem] += repeat[id_cmd];
        else if (cmd[id_cmd] == '-')
            mem[id_mem] -= repeat[id_cmd];
        else if (cmd[id_cmd] == '.')
            write(1, &mem[id_mem], 1);
        else if (cmd[id_cmd] == ',') {
            mem[id_mem] = *input;
            if (*input)
                ++input;
        }
        else if (cmd[id_cmd] == '[')
            if (mem[id_mem])
                continue;
            else {
                layer = -1;
                while (layer != 0) {
                    ++id_cmd;
                    if (cmd[id_cmd] == ']')
                        ++layer;
                    else if (cmd[id_cmd] == '[')
                        --layer;
                }
            }
        else if (cmd[id_cmd] == ']' && mem[id_mem]) {
            layer = -1;
            while (layer != 0) {
                --id_cmd;
                if (cmd[id_cmd] == '[')
                    ++layer;
                else if (cmd[id_cmd] == ']')
                    --layer;
            }
        }
    }
}

int main(int ac, char const **av)
{
    const char *cmd = av[1];
    const char *input = (ac < 3) ? "" : av[2];
    unsigned short *repeat;

    repeat = opti_cmd(&cmd);
    opti_interpreter(cmd, repeat, input);
    return (0);
}