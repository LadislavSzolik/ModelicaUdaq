#ifndef _UDAQ28LT_DRIVER_
#define _UDAQ28LT_DRIVER_

#include <usb.h>

// inicializuje zariadenie a vrati handle
usb_dev_handle* udaq28lt_init();

// nastavi vstupne napatia na zariadeni
void udaq28lt_write(usb_dev_handle *handle, double lamp, double led, double fan);

// nacita vystupne hodnoty zo zariadenia
// vrati -1 ak prisli chybne data. inak 0
int udaq28lt_read(usb_dev_handle *handle, double *temp, double *ftemp, double *light, double *flight, double *fan, double *fanrpm);

// posle na zariadenie nuly a ukonci komunikaciu
void udaq28lt_close(usb_dev_handle *handle);

usb_dev_handle* getUdaq();

usb_dev_handle* udaq_init();
const char* om_read_write(double lamp, double fan, double led);
double om_read();
void om_write(double lamp, double fan, double led);
double tester(double x);

double transformStr(const char* strArr, int choose);
#endif
