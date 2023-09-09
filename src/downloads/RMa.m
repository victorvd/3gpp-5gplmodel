function PLRMa = RMa(fc,d2D,hBS,hUT,h,W)
%Rural Macro
%PLRMa function returns a RMa LoS and NLoS; path loss values matrix.
%- fc is the center frequency / carrier frequency in GHz.
%- d2D is the 2D distance between Tx and Rx in m.
%- hBS is the antenna height for BS in m.
%- hUT is the antenna height for UT.
%- h is the average building height in m.
%- W is the average street width in m.

c=3.0e8;

if (isequal(size(fc),[1 1]) && ~isequal(size(d2D),[1 1]))
    PLRMa = Inf(2,length(d2D));
    PLRMa_p = zeros(1,length(d2D));
    fc = fc(1,1).*ones(1,length(d2D));
    x = d2D;
    legX = 'd2D [m]';
    disp('Iteración en distancia...')
    
elseif (~isequal(size(fc),[1 1]) && isequal(size(d2D),[1 1]))
    PLRMa = zeros(2,length(fc));
    PLRMa_p = zeros(1,length(fc));
    d2D = d2D(1,1).*ones(1,length(fc));
    x = fc;
    legX = 'fc [GHz]';
    disp('Iteración en frecuencia...')
end

d3D=sqrt(d2D.^2+(hBS-hUT)^2);
dBP = 2*pi*hBS*hUT*fc.*1e9/c;

for i=1:length(d2D)
    %LOS
    if d2D(1,i) <= dBP(1,1) && d2D(1,i) >= 10
        PLRMa(1,i) = 20*log10(40*pi*d3D(1,i)*fc(1,i)/3)+min(0.03*h^1.72,10)*log10(d3D(1,i))-min(0.044*h^1.72,14.77)+0.002*log10(h)*d3D(1,i);
    elseif d2D(1,i) <= 10000 && d2D(1,i) >= dBP(1,i)
        PLRMa(1,i) = 20*log10(40*pi*dBP(1,i)*fc(1,i)/3)+min(0.03*h^1.72,10)*log10(dBP(1,i))-min(0.044*h^1.72,14.77)+0.002*log10(h)*dBP(1,i)+40*log10(d3D(1,i)/dBP(1,i));
    end
    
    %NLOS
    if d2D(1,i) <= 5000 && d2D(1,i) >= 10
        PLRMa_p(1,i) = 161.04-7.1*log10(W)+7.5*log10(h)-(24.37-3.7*(h/hBS)^2)*log10(hBS)+(43.42-3.1*log10(hBS))*(log10(d3D(1,i))-3)+20*log10(fc(1,i))-(3.2*log10(11.75*hUT)^2-4.97);
        PLRMa(2,i) = max(PLRMa(1,i),PLRMa_p(1,i));
    end
end

subplot(2,1,1)
plot(x,PLRMa(1,:),'b')
title('Rural Macrocell LOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
grid on

subplot(2,1,2)
plot(x,PLRMa(2,:),'r')
title('Rural Macrocell NLOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
grid on

%Fin de la función
end
