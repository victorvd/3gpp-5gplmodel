function PrLOS = Prob(d2D, hut, scenario)
%LOS
    if (scenario=='UMi')
        for i=1:length(d2D)
                if d2D(1,i) <= 18
                    PrLOS(1,i)=1;
                else
                    PrLOS(1,i)=18/d2D(1,i)+exp(-d2D(1,i)/36)*(1-18/d2D(1,i));
                end
        end
        
        plot(d2D,PrLOS)
        title('Probabilidad de LOS para UMi')
        xlabel('Distancia 2d [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        legend('UMi model')
        grid on
        
    elseif (scenario=='UMa')
        for i=1:length(hut)
            if hut(1,i) <= 13
                c_hut(1,i)=0;
            else
                c_hut(1,i)=((hut(1,i)-13)/10)^1.5;
            end
            
            for j=1:length(d2D)
                if d2D(1,j) <= 18
                    PrLOS(i,j)=1;
                else
                    PrLOS(i,j)=(min(18/d2D(1,j),1)*(1-exp(-d2D(1,j)/63))+exp(-d2D(1,j)/63))*(1+c_hut(1,i)*5/4*(d2D(1,j)/100)^3*exp(-d2D(1,j)/150));
                end
            end
        end
        
        plot(d2D,PrLOS)
        title('Probabilidad de LOS para UMa')
        xlabel('Distancia 2d [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        %legappend(['h =',hut(1,i),'m'])
        legend('h = 1.5 m', 'h = 4.5 m', 'h = 7.5 m', 'h = 10.5 m', 'h = 13.5 m', 'h = 16.5 m', 'h = 19.5 m', 'h = 22.5 m')
        grid on
        
    elseif (scenario=='RMa')
        for i=1:length(d2D)
                if d2D(1,i) <= 10
                    PrLOS(1,i)=1;
                elseif d2D(1,i) > 10
                    PrLOS(1,i)=exp(-(d2D(1,i)-10)/1000);
                end
        end
        plot(d2D,PrLOS)
        title('Probabilidad de LOS para RMa')
        xlabel('Distancia 2d [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        legend('RMa model')
        grid on
    
    elseif (scenario=='InH')
        for i=1:length(d2D)
            if d2D(1,i) <= 1.2
                PrLOS(1,i)=1;
            elseif 1.2 < d2D(1,i) && d2D(1,i) < 6.5
                PrLOS(1,i)=exp(-(d2D(1,i)-1.2)/4.7);
            elseif 6.5 <= d2D(1,i)
                PrLOS(1,i)=exp(-(d2D(1,i)-6.5)/32.6)*0.32;
            end
        end
        
        for i=1:length(d2D)
            if (d2D(1,i)<=5)
                PrLOS(2,i)=1;
            elseif 5<d2D(1,i) && d2D(1,i)<=49
                PrLOS(2,i)=exp(-(d2D(1,i)-5)/70.8);
            elseif 49<d2D(1,i)
                PrLOS(2,i)=exp(-(d2D(1,i)-49)/211.7)*0.54;
            end
        end

        plot(d2D,PrLOS)
        title('Probabilidad de LOS para InH')
        xlabel('Distancia 2d [m]') % x-axis label
        ylabel('Probabilidad') % y-axis label
        legend('InH-Mixed Office','InH-Open Office')
        grid on
    end
end