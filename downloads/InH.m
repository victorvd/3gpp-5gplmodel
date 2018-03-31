function PLInH = InH(fc,d2D,hBS,hUT)
%Indoor Hotspot
%PLInH function returns a InH LoS, NLoS and NLoS_optional; path loss values matrix.
%- fc is the center frequency / carrier frequency in GHz.
%- d2D is the 2D distance between Tx and Rx in m.
%- hBS is the antenna height for BS in m.
%- hUT is the antenna height for UT.

c=3.0e8;

if hUT < 13
    C_d2D_hUT = 0;
elseif hUT >= 13 && hUT <= 23
    C_d2D_hUT = ((hUT-13)/10)^1.5.*g(d2D)
end

if (isequal(size(fc),[1 1]) && ~isequal(size(d2D),[1 1]))
    PLInH = Inf(3,length(d2D));
    PLInH_p = zeros(3,length(d2D));
    fc = fc(1,1).*ones(1,length(d2D));
    x = d2D;
    legX = 'd2D [m]';
    disp('Iteración en distancia...')
    
elseif (~isequal(size(fc),[1 1]) && isequal(size(d2D),[1 1]))
    PLInH = zeros(3,length(fc));
    PLInH_p = zeros(3,length(fc));
    d2D = d2D(1,1).*ones(1,length(fc));
    x = fc;
    legX = 'fc [GHz]';
    disp('Iteración en frecuencia...')
end

d3D=sqrt(d2D.^2+(hBS-hUT)^2);

for i=1:length(x)
    %LOS
    if d3D(1,i) <= 100 && d3D(1,i) >= 1
        PLInH(1,i) = 32.4+17.3*log10(d3D(1,i))+20*log10(fc(1,i));
    end
    
    %NLOS
    if d3D(1,i) <= 86 && d3D(1,i) >= 1
        PLInH_p(1,i) = 17.3+38.3*log10(d3D(1,i))+24.9*log10(fc(1,i));
        PLInH(2,i) = max(PLInH(1,i),PLInH_p(1,i));
        %OPTIONAL PATH LOSS
        PLInH(3,i)=32.4+20*log10(fc(1,i))+31.9*log10(d3D(1,i));
    end
end

subplot(2,1,1)
plot(x,PLInH(1,:),'b')
title('Indoor Hotspot LOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
legend('InH LOS model','Location','southeast')
grid on

subplot(2,1,2)
plot(x,PLInH(2,:),'r'); hold on;
plot(x,PLInH(3,:),'g');
title('Indoor Hotspot NLOS')
xlabel(legX) % x-axis label
ylabel('Path Loss [dB]') % y-axis label
legend('InH NLOS model', 'InH NLOS optional','Location','southeast')
grid on

end
function g = g(d2D)
if d2D <= 18
    g = 0;
elseif d2D > 18
    g = 5/4*(d2D/100)^3.*exp(-d2D./150);
end
end
