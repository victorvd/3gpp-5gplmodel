function PrLoS = Prlos(d2D, hUT, scenario)
%LoS probability
%Prlos function returns a line-of-sight probability matrix based in the
%distance y the height inputs. It depends on the scenario as well.
%d2D is the 2D distance between Tx and Rx in m. It can be a single value or
%a range.
%hUT is the antenna height for UT. It can be a single value or a range.
%'scenario' must be selected from "RMa", "UMa", "UMi" or "InH".

    if (scenario=='UMi')
        for i=1:length(d2D)
                if d2D(1,i) <= 18
                    PrLoS(1,i)=1;
                else
                    PrLoS(1,i)=18/d2D(1,i)+exp(-d2D(1,i)/36)*(1-18/d2D(1,i));
                end
        end
        
        plot(d2D,PrLoS)
        title('Probabilidad de LoS para UMi')
        xlabel('Distancia d2D-out [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        legend('UMi model')
        grid on
        
    elseif (scenario=='UMa')
        for i=1:length(hUT)
            if hUT(1,i) <= 13
                c_hUT(1,i)=0;
            else
                c_hUT(1,i)=((hUT(1,i)-13)/10)^1.5;
            end
            
            for j=1:length(d2D)
                if d2D(1,j) <= 18
                    PrLoS(i,j)=1;
                else
                    PrLoS(i,j)=(min(18/d2D(1,j),1)*(1-exp(-d2D(1,j)/63))+exp(-d2D(1,j)/63))*(1+c_hUT(1,i)*5/4*(d2D(1,j)/100)^3*exp(-d2D(1,j)/150));
                end
            end
        end
        
        plot(d2D,PrLoS)
        title('Probabilidad de LoS para UMa')
        xlabel('Distancia d2D-out [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        %legappend(['h =',hUT(1,i),'m'])
        legend('hUT = 1.5 m', 'hUT = 4.5 m', 'hUT = 7.5 m', 'hUT = 10.5 m', 'hUT = 13.5 m', 'hUT = 16.5 m', 'hUT = 19.5 m', 'hUT = 22.5 m')
        grid on
        
    elseif (scenario=='RMa')
        for i=1:length(d2D)
                if d2D(1,i) <= 10
                    PrLoS(1,i)=1;
                elseif d2D(1,i) > 10
                    PrLoS(1,i)=exp(-(d2D(1,i)-10)/1000);
                end
        end
        plot(d2D,PrLoS)
        title('Probabilidad de LoS para RMa')
        xlabel('Distancia d2D-out [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        legend('RMa model')
        grid on
    
    elseif (scenario=='InH')
        for i=1:length(d2D)
            if d2D(1,i) <= 1.2
                PrLoS(1,i)=1;
            elseif 1.2 < d2D(1,i) && d2D(1,i) < 6.5
                PrLoS(1,i)=exp(-(d2D(1,i)-1.2)/4.7);
            elseif 6.5 <= d2D(1,i)
                PrLoS(1,i)=exp(-(d2D(1,i)-6.5)/32.6)*0.32;
            end
        end
        
        for i=1:length(d2D)
            if (d2D(1,i)<=5)
                PrLoS(2,i)=1;
            elseif 5<d2D(1,i) && d2D(1,i)<=49
                PrLoS(2,i)=exp(-(d2D(1,i)-5)/70.8);
            elseif 49<d2D(1,i)
                PrLoS(2,i)=exp(-(d2D(1,i)-49)/211.7)*0.54;
            end
        end

        plot(d2D,PrLoS)
        title('Probabilidad de LoS para InH')
        xlabel('Distancia d2D-in [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        legend('InH-Mixed Office','InH-Open Office')
        grid on
    end
end
