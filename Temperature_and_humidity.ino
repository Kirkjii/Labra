
#include <limits.h>  
using namespace std;

//Kosteusmittaus, esimerkki H25K5
//Esivastus megaohmin luokkaa
//Taajuuden generointi PVM:llä nastaan 5, taajuus 980Hz
//AD-muuntimen kanava 0
//AD-muuntimella luetaan kkeskeytyksin 125 näytettä taulukkoon(jakso),joista haetaan maksimi.
//Maksimi on verrannollinen kosteuteen
//Kalibrointitaulukkon on otettu 4 arvoparia, joista lasketaan kosteus

int analogVal;
int taul[125];
int cnt=0;
int maxval=0;
int arvo=0;
int i;
int ad[4]={995,767,567,300}; //ad-muuntimen arvo
float kost[4]={26.2,40,60,83.5}; //vastaava kostesuarvo
float kosteus;
int x = 0;


float kty(unsigned int port)
{
float temp              = 82;
ADCSRA = 0x00;
ADCSRA = (1<<ADEN)|(1<<ADPS2)|(1<<ADPS1)|(1<<ADPS0);
ADMUX = 0x00;
ADMUX = (1<<REFS0);
ADMUX |= port;    
for (int i=0;i<=64;i++)
  {
       ADCSRA|=(1<<ADSC);
       while (ADCSRA & (1<<ADSC));
       temp += (ADCL + ADCH*256);
  }

       temp /= 101;
       temp -= 156;
       return (temp);
}
 
float lueKosteus()
{
noInterrupts();
ADMUX &= B11011111;
ADMUX |= B01000000;
ADMUX &= B11110000;
//ADMUX |= 8;
ADCSRA |= B10000000;
ADCSRA |= B00100000;
ADCSRB &= B11111000;
ADCSRA |= B00000111;
ADCSRA |= B00001000;
ADCSRA |=B01000000;
interrupts();
 
if (arvo>= ad[0]) kosteus=kost[0]-(kost[0]-0)*(arvo-ad[0])/(1023-ad[0]);
else if (arvo<ad[0] && arvo>=ad[1]) kosteus=kost[1]-(kost[1]-kost[0])*(arvo-ad[1])/(ad[0]-ad[1]);
else if (arvo<ad[1] && arvo>=ad[2]) kosteus=kost[2]-(kost[2]-kost[1])*(arvo-ad[2])/(ad[1]-ad[2]);
else if (arvo<ad[2] && arvo>=ad[3]) kosteus=kost[3]-(kost[3]-kost[2])*(arvo-ad[3])/(ad[2]-ad[3]);
else kosteus = 100 - (100-kost[3])*(arvo-0)/(ad[3]-0);
 
return kosteus;      
}

void setup() 
{ 
 Serial.begin(9600);  
 analogWrite(5,128); //980Hz PWM, pin 5
}



void loop() 
{ 
float read_hum = lueKosteus();
Serial.print(read_hum); 
delay(200);
float read_temp = kty(1);
Serial.print("\t");
delay(200);         
Serial.println(read_temp); 
delay(3600000);
//1800000
}

ISR(ADC_vect)
{
 analogVal = ADCL | (ADCH << 8);
 taul[cnt]=analogVal;
 cnt++;
 if(cnt==125)
 {
 maxval=taul[0];
 for(i=0;i<125;i++)
 {
 if (maxval<taul[i+1]) maxval=taul[i+1];
 }
 arvo=maxval;
 cnt=0;
 }
}
