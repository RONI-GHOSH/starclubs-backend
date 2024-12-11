BEGIN
DECLARE i int default 0;
DECLARE done INT DEFAULT FALSE;
DECLARE done2query INT DEFAULT FALSE;
DECLARE b_member_id INT DEFAULT FALSE;
DECLARE b_game_id INT DEFAULT FALSE;
DECLARE b_game_cid INT DEFAULT FALSE;
DECLARE member_Walletbalance INT DEFAULT 0;
DECLARE updated_Walletbalance INT DEFAULT 0;
DECLARE secondbetting_amount INT DEFAULT 0;
DECLARE firstbetting_amount INT DEFAULT 0;
DECLARE betting_number VARCHAR(250) default null;
DECLARE betting_time_type VARCHAR(250) default null;
DECLARE betting_amount INT DEFAULT 0;
DECLARE total_amount INT DEFAULT 0;
DECLARE battingrate Double DEFAULT 0;
DECLARE winningamount int default 0;
DECLARE currentdate VARCHAR(250) default null;
DECLARE jodi VARCHAR(250) default null;
DECLARE bettingnumber INT default 0;
DECLARE singlebettingnumber INT default 0;
DECLARE query LongText default null;
DECLARE transactionid VARCHAR(250) default null;
DECLARE marketname VARCHAR(250) default null;
DECLARE gamename VARCHAR(250) default null;
DECLARE query2 VARCHAR(250) default null;




set currentdate=Now();

IF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("10:00 AM", '%l:%i %p')
THEN

set query2="A";

select bt.A into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("11:00 AM", '%l:%i %p')
THEN

set query2="B";

select bt.B into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("12:00 PM", '%l:%i %p')
THEN

set query2="C";
select bt.C into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("1:00 PM", '%l:%i %p')
THEN

set query2="D";
select bt.D into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("2:00 PM", '%l:%i %p')
THEN

set query2="E";
select bt.E into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("3:00 PM", '%l:%i %p')
THEN

set query2="F";
select bt.F into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("4:00 PM", '%l:%i %p')
THEN

set query2="G";

select bt.G into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;
ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("5:00 PM", '%l:%i %p')
THEN

set query2="H";

select bt.H into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("6:00 PM", '%l:%i %p')
THEN

set query2="I";

select bt.I into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("7:00 PM", '%l:%i %p')
THEN

set query2="J";

select bt.J into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("8:00 PM", '%l:%i %p')
THEN

set query2="K";
select bt.K into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("9:00 PM", '%l:%i %p')
THEN

set query2="L";

select bt.L into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("10:00 PM", '%l:%i %p')
THEN

set query2="M";

select bt.M into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;


ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("11:00 PM", '%l:%i %p')
THEN

set query2="N";
select bt.N into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;


ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("12:00 AM", '%l:%i %p')
THEN

set query2="O";

select bt.O into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;


ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("01:00 AM", '%l:%i %p')
THEN
set query2="P";

select bt.P into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("02:00 AM", '%l:%i %p')
THEN

set query2="Q";

select bt.Q into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("03:00 AM", '%l:%i %p')
THEN
set query2="R";

select bt.R into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("04:00 AM", '%l:%i %p')
THEN

set query2="S";

select bt.S into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;


ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("05:00 AM", '%l:%i %p')
THEN

set query2="T";
select bt.T into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("06:00 AM", '%l:%i %p')
THEN

set query2="U";

select bt.U into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;


ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("07:00 AM", '%l:%i %p')
THEN

set query2="V";

select bt.V into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("08:00 AM", '%l:%i %p')
THEN

set query2="W";

select bt.W into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;

ELSEIF STR_TO_DATE(starlinemarkettype, '%l:%i %p')=STR_TO_DATE("09:00 AM", '%l:%i %p')
THEN

set query2="X";

select bt.X into betting_number from colormarket bt where Date(bt.betting_time)=Date(currentdate) limit 1;
ELSE
set query2="Y";

END IF;





set singlebettingnumber= ufn_getsumvalue(betting_number);

set query=Concat("select bt.member_id, bt.game_id, bt.bet_amount,bt.bet_num from colormarketbat bt where bt.statLineBatTime=",starlinemarkettype," AND date(bt.betting_date)=Date(",currentdate,") AND bt.bet_num=",betting_number );


set done =false;
BEGIN

DECLARE cur1 CURSOR FOR select bt.member_id, bt.game_id, bt.bet_amount,bt.bet_num from colormarketbat bt where Time(bt.statLineBatTime)=Time(starlinemarkettype) AND date(bt.betting_date)=Date(currentdate) AND (bt.bet_num=betting_number OR bt.bet_num=singlebettingnumber);
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
OPEN cur1;
read_loop: LOOP
FETCH cur1 INTO b_member_id,b_game_id,betting_amount,bettingnumber;
IF done THEN
LEAVE read_loop;
END IF;

IF b_game_id=16
THEN
select gr.gameRate,gr.gameName INTO battingrate,gamename from colorRate gr where gr.id=1;
set winningamount=betting_amount*battingrate/10;
select mw.member_wallet_balance INTO member_Walletbalance from member_wallet mw where mw.member_id=b_member_id;
set updated_Walletbalance=member_Walletbalance+winningamount;

update member_wallet set member_wallet_balance=updated_Walletbalance where member_id=b_member_id;

set transactionid=Ufn_GenrateTransactionId();

INSERT INTO `colorbattrasectionhistory`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'StarLine0Bat',gamename,bettingnumber);


INSERT INTO `wallet_transaction`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `market_name`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'WinningBat','Color','Color',bettingnumber);

ELSEIF b_game_id=17
THEN

select gr.gameRate,gr.gameName INTO battingrate,gamename from colorRate gr where gr.id=2;
set winningamount=betting_amount*battingrate/10;
select mw.member_wallet_balance INTO member_Walletbalance from member_wallet mw where mw.member_id=b_member_id;
set updated_Walletbalance=member_Walletbalance+winningamount;

update member_wallet set member_wallet_balance=updated_Walletbalance where member_id=b_member_id;

set transactionid=Ufn_GenrateTransactionId();

INSERT INTO `colorbattrasectionhistory`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'StarLineBat',gamename,bettingnumber);

INSERT INTO `wallet_transaction`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `market_name`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'WinningBat','Lotter_Number','Lotter_Number',bettingnumber);

ELSEIF b_game_id=4
THEN

select gr.gameRate,gr.gameName INTO battingrate,gamename from colorRate gr where gr.id=3;
set winningamount=betting_amount*battingrate/10;
select mw.member_wallet_balance INTO member_Walletbalance from member_wallet mw where mw.member_id=b_member_id;
set updated_Walletbalance=member_Walletbalance+winningamount;

update member_wallet set member_wallet_balance=updated_Walletbalance where member_id=b_member_id;

set transactionid=Ufn_GenrateTransactionId();

INSERT INTO `colorbattrasectionhistory`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'StarLineBat',gamename,bettingnumber);

INSERT INTO `wallet_transaction`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `market_name`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'WinningBat','StarLine','StarLine',bettingnumber);

ELSEIF b_game_id=5
THEN

select gr.gameRate,gr.gameName INTO battingrate,gamename from colorRate gr where gr.id=4;
set winningamount=betting_amount*battingrate/10;
select mw.member_wallet_balance INTO member_Walletbalance from member_wallet mw where mw.member_id=b_member_id;
set updated_Walletbalance=member_Walletbalance+winningamount;

update member_wallet set member_wallet_balance=updated_Walletbalance where member_id=b_member_id;
set transactionid=Ufn_GenrateTransactionId();

INSERT INTO `colorbattrasectionhistory`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`,`transaction_type`, `game_name`, `bat_number`)VALUES (transactionid,winningamount,b_member_id,currentdate,'StarLineBat',gamename,bettingnumber);

INSERT INTO `wallet_transaction`( `transaction_id`, `transaction_amount`, `member_id`, `transaction_update_date`, `transaction_type`, `market_name`, `game_name`, `bat_number`) VALUES (transactionid,winningamount,b_member_id,currentdate,'WinningBat','StarLine','StarLine',bettingnumber);
END IF;

set updated_Walletbalance=0;
set winningamount=0;
set member_Walletbalance=0;


ITERATE read_loop;
END LOOP read_loop;
CLOSE cur1;
END;

Select "success" as status,total_amount,winningamount,b_game_cid,query2,query,b_member_id,betting_number,singlebettingnumber;
END