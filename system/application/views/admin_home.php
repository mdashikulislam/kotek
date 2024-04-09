<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
    <table cellpadding="3" cellspacing="0" border="0" class="dashboardTableWrapper">
    <tr>
      <th width="140"> Name </th>
      <th width="340"> Description </th>
      <th width="140"> Name </th>
      <th width="340"> Description </th>
    </tr>
    <tr class="odd">
      <td><?php $adata = array('title'=>"Manage Pages"); echo anchor("admin/pages/","Manage Pages",$adata);?></td>
      <td> Edit, delete and manage Pages fonts on your online store. </td>
      <!-- <td><?php //echo anchor("admin/videos/","Manage Videos");?></td>
      <td>Create, edit, delete and manage Videos fonts on your online store. </td>-->
      <td><?php $adata = array('title'=>"Manage Distributors"); echo anchor("admin/distributors/","Manage Distributors",$adata);?></td>
      <td> Create, edit, delete and manage Distributors on your online store. </td>
    </tr>
    <tr class="even">
      <td><?php $adata = array('title'=>"Manage FAQ"); echo anchor("admin/faq/","Manage FAQ",$adata);?></td>
      <td> Create, edit, delete and manage FAQs on your online store. </td>
      <td><?php $adata = array('title'=>"Manage Customers"); echo anchor("admin/orders/customers/","Manage Customers",$adata);?></td>
      <td> Manage Customers and send out emails. </td>
     
    </tr>
    <tr class="odd" >
      <td><?php $adata = array('title'=>"Manage News"); echo anchor("admin/news/","Manage News",$adata);?></td>
      <td> Create, edit, delete and manage News on your online store. </td>
      <td><?php $adata = array('title'=>"Manage Subscribers"); echo anchor("admin/subscribers/","Manage Subscribers",$adata);?></td>
      <td> Manage Subscribers and send out emails. </td>
      
    </tr>
    <tr class="even">
      <td><?php $adata = array('title'=>"Manage Testimonials"); echo anchor("admin/testimonial/","Manage Testimonials",$adata);?></td>
      <td> Create, edit, delete and manage Testimonials on your online store. </td>
        <td><?php $adata = array('title'=>"Manage Banners"); echo anchor("admin/banner/","Manage Banners",$adata);?></td>
      <td> Create, edit, delete and manage Banners on your online store. </td>
    </tr>
    <tr class="odd">
      <td><?php $adata = array('title'=>"Manage Products"); echo anchor("admin/products/","Manage Products",$adata);?></td>
      <td> Create, edit, delete and manage Products on your online store. </td>
      <td><?php $adata = array('title'=>"Manage Users"); echo anchor("admin/admins/","Manage Admin Users",$adata);?></td>
      <td> Create, edit, delete and manage Admin Users on your online store. </td>
    </tr>
    <tr class="even">
      <td><?php $adata = array('title'=>"Manage Groups"); echo anchor("admin/categories/","Manage Groups",$adata);?></td>
      <td> Create, edit, delete and manage Groups on your online store. </td>
    <td><?php $adata = array('title'=>"Logout"); echo anchor("admin/dashboard/logout/","Logout",$adata);?></td>
      <td>Exit this Quick Links when you're done. </td>  
    </tr>
    <tr class="odd">
      <td><?php $adata = array('title'=>"Manage Makers"); echo anchor("admin/maker/","Manage Makers",$adata);?></td>
      <td> Create, edit, delete and manage Makers on your online store. </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    
    
    
    
    
    
     
  </table>
</div>