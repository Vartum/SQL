#ifndef FUNCTIONS_H
#define FUNCTIONS_H

#define N 1000

void form_t(int n, float* t, float& dt);
void form_Uvx(int n, float* t, float* Uvx);
void form_Uvix(int n, float* Uvx, float* Uvix);
void form_tabl(int n, float* t, float* Uvx, float* Uvix);
float parametr(int n, float* Uvx, float dt);
void write_to_file(int n, float* t, float* Uvx, float* Uvix);
void read_zastavka();
void calc_param_with_precision(float eps);

#endif