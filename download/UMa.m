function PLUMa = UMa(fc,d2D,hBS,hUT)
%Urban Macro

c=3.0e8;
hE = 1;
h_BS = hBS-hE;
h_UT = hUT-hE;

if hUT < 13
    C_d2D_hUT = 0;
elseif hUT >= 13 && hUT <= 23
    C_d2D_hUT = ((hUT-13)/10)^1.5.*g(d2D)
end

if (isequal(size(fc),[1 1]) && ~isequal(size(d2D),[1 1]))
    PLUMa = Inf(3,length(d2D));
    PLUMa_p = zeros(3,length(d2D));
    fc = fc(1,1).*ones(1,length(d2D));
    x = d2D;
    legX = 'd2D [m]';
    disp('Iteración en distancia...')
    
elseif (~isequal(size(fc),[1 1]) && isequal(size(d2D),[1 1]))
    PLUMa = zeros(3,length(fc));
    PLUMa_p = zeros(3,length(fc));
    d2D = d2D(1,1).*ones(1,length(fc));
    x = fc;
    legX = 'fc [GHz]';
    disp('Iteración en frecuencia...')
end

d3D=sqrt(d2D.^2+(hBS-hUT)^2);
dBPp = 4*h_BS*h_UT.*fc*1e9/c;

for i=1:length(x)
    %LOS
    if d2D(1,i) <= dBPp(1,i) && d2D(1,i) >= 10
        PLUMa(1,i) = 28+22*log10(d3D(1,i))+20*log10(fc(1,i));
    elseif d2D(1,i) <= 5000 && d2D(1,i) >= dBPp(1,i)
        PLUMa(1,i) = 28+40*log10(d3D(1,i))+20*log10(fc(1,i))-9*log10(dBPp(1,i)^2+(hBS-hUT)^2);
    end
    
    %NLOS
    if d2D(1,i) <= 5000 && d2D(1,i) >= 10
        PLUMa_p(1,i) = 13.54+39.08*log10(d3D(1,i))+20*log10(fc(1,i))-0.6*(hUT-1.5);
        PLUMa(2,i) = max(PLUMa(1,i),PLUMa_p(1,i));
        %OPTIONAL PATH LOSS
        PLUMa(3,i)=32.4+20*log10(fc(1,i))+30*log10(d3D(1,i));
    end
end

subplot(2,1,1)
plot(x,PLUMa(1,:),'b')
title('Urban Macrocell LOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
legend('UMa LOS model','Location','southeast')
grid on

subplot(2,1,2)
plot(x,PLUMa(2,:),'g'); hold on;
plot(x,PLUMa(3,:),'r');
title('Urban Macrocell NLOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
legend('UMa NLOS model', 'UMa NLOS optional','Location','southeast')
grid on

%Fin de la función
end

function g = g(d2D)
if d2D <= 18
    g = 0;
elseif d2D > 18
    g = 5/4*(d2D/100)^3.*exp(-d2D./150);
end
end