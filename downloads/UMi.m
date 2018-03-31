function PLUMi = UMi(fc,d2D,hBS,hUT)
%Urban Micro
%PLUMi function returns a UMi LoS, NLoS and NLoS_optional; path loss values matrix.
%- fc is the center frequency / carrier frequency in GHz.
%- d2D is the 2D distance between Tx and Rx in m.
%- hBS is the antenna height for BS in m.
%- hUT is the antenna height for UT.

c=3.0e8;
hE = 1;
h_BS = hBS-hE;
h_UT = hUT-hE;

if hUT < 13
    C_d2D_hUT = 0;
elseif hUT >= 13 && hUT <= 23
    C_d2D_hUT = ((hUT-13)/10)^1.5.*g(d2D);
end

if (isequal(size(fc),[1 1]) && ~isequal(size(d2D),[1 1]))
    PLUMi = Inf(3,length(d2D));
    PLUMi_p = zeros(3,length(d2D));
    fc = fc(1,1).*ones(1,length(d2D));
    x = d2D;
    legX = 'd2D [m]';
    disp('Iteración en distancia...')
    
elseif (~isequal(size(fc),[1 1]) && isequal(size(d2D),[1 1]))
    PLUMi = zeros(3,length(fc));
    PLUMi_p = zeros(3,length(fc));
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
        PLUMi(1,i) = 32.4+21*log10(d3D(1,i))+20*log10(fc(1,i));
    elseif d2D(1,i) <= 5000 && d2D(1,i) >= dBPp(1,i)
        PLUMi(1,i) = 32.4+40*log10(d3D(1,i))+20*log10(fc(1,i))-9.5*log10(dBPp(1,i)^2+(hBS-hUT)^2);
    end
    
    %NLOS
    if d2D(1,i) <= 5000 && d2D(1,i) >= 10
        PLUMi_p(1,i) = 22.4+35.3*log10(d3D(1,i))+21.3*log10(fc(1,i))-0.3*(hUT-1.5);
        PLUMi(2,i) = max(PLUMi(1,i),PLUMi_p(1,i));
        %OPTIONAL PATH LOSS
        PLUMi(3,i)=32.4+20*log10(fc(1,i))+31.9*log10(d3D(1,i));
    end
end

subplot(2,1,1)
plot(x,PLUMi(1,:),'b')
title('Urban Microcell LOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
legend('UMi LOS model','Location','southeast')
grid on

subplot(2,1,2)
plot(x,PLUMi(2,:),'r'); hold on;
plot(x,PLUMi(3,:),'g');
title('Urban Microcell NLOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
legend('UMi NLOS model', 'UMi NLOS optional','Location','southeast')
grid on

end
function g = g(d2D)
if d2D <= 18
    g = 0;
elseif d2D > 18
    g = 5/4*(d2D/100)^3.*exp(-d2D./150);
end
end
