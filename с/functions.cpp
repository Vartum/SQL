#include <stdio.h>
#include <math.h>
#include <iostream>
#include "functions.h"

using namespace std;

// Формирование массива времени
void form_t(int n, float* t, float& dt) {
    float tn = 10, tk = 35;
    dt = (tk - tn) / (n - 1);
    for (int i = 0; i < n; i++) {
        t[i] = tn + i * dt;
    }
}

// Формирование массива Uvx
void form_Uvx(int n, float* t, float* Uvx) {
    float t1 = 22.5, a = 12, b = 12, tn = 10;
    for (int i = 0; i < n; i++) {
        if (t[i] < t1) {
            Uvx[i] = a * (t[i] - tn);
        } else {
            Uvx[i] = a * (t1 - tn) - b * (t[i] - t1);
        }
    }
}

// Формирование массива Uvix
void form_Uvix(int n, float* Uvx, float* Uvix) {
    float Uvx1 = 5, Uvx2 = 25, U1 = 20, U2 = 150;
    for (int i = 0; i < n; i++) {
        if (Uvx[i] < Uvx1) {
            Uvix[i] = U1;
        } else if (Uvx[i] <= Uvx2) {
            Uvix[i] = 6.5 * Uvx[i] - 12.5;
        } else {
            Uvix[i] = U2;
        }
    }
}

// Вывод таблицы
void form_tabl(int n, float* t, float* Uvx, float* Uvix) {
    cout << " №     t     Uvx   Uvix" << endl;
    for (int i = 0; i < n; i++) {
        printf("%3d   %6.3f   %6.3f   %6.3f\n", i, t[i], Uvx[i], Uvix[i]);
    }
}

// Расчет длительности импульса
float parametr(int n, float* Uvx, float dt) {
    float Umax = Uvx[0], Umin = Uvx[0];
    for (int i = 1; i < n; i++) {
        if (Uvx[i] > Umax) Umax = Uvx[i];
        if (Uvx[i] < Umin) Umin = Uvx[i];
    }
    float Uimp = Umin + 0.5 * (Umax - Umin);
    float dlit = 0;
    for (int i = 0; i < n; i++) {
        if (Uvx[i] >= Uimp) dlit += dt;
    }
    return dlit;
}

// Запись данных в файлы
void write_to_file(int n, float* t, float* Uvx, float* Uvix) {
    FILE *f1 = fopen("massiv_t.txt", "w");
    FILE *f2 = fopen("massiv_Uvx.txt", "w");
    FILE *f3 = fopen("massiv_Uvix.txt", "w");
    for (int i = 0; i < n; i++) {
        fprintf(f1, "%6.3f\n", t[i]);
        fprintf(f2, "%6.3f\n", Uvx[i]);
        fprintf(f3, "%6.3f\n", Uvix[i]);
    }
    fclose(f1);
    fclose(f2);
    fclose(f3);
}

// Чтение заставки
void read_zastavka() {
    FILE *f = fopen("zast.txt", "r");
    if (f == NULL) {
        cout << "Ошибка открытия файла zast.txt" << endl;
        return;
    }
    char ch;
    while (!feof(f)) {
        fscanf(f, "%c", &ch);
        printf("%c", ch);
    }
    fclose(f);
}

// Расчет параметра с заданной точностью
void calc_param_with_precision(float eps) {
    float t[N], Uvx[N], Uvix[N], dt;
    float par = 1e10, par1, p = 1;
    int n = 11;
    while (p > eps) {
        form_t(n, t, dt);
        form_Uvx(n, t, Uvx);
        form_Uvix(n, Uvx, Uvix);
        par1 = parametr(n, Uvx, dt);
        p = fabs(par - par1) / par1;
        cout << "n=" << n << " parametr=" << par1 << " pogrechnost=" << p << endl;
        par = par1;
        n *= 2;
    }
}